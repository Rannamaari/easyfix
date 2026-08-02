<?php

namespace App\Filament\Resources;

use App\Enums\JobStatus;
use App\Filament\Resources\JobRequestResource\Pages;
use App\Models\BookingSetting;
use App\Models\JobRequest;
use App\Models\User;
use App\Services\SmsNotifier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobRequestResource extends Resource
{
    protected static ?string $model = JobRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        $count = $user->unreadMessageCount();

        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer / Guest Details')
                    ->schema([
                        Forms\Components\Toggle::make('is_guest')
                            ->label('Guest Request (no account)')
                            ->default(false)
                            ->live()
                            ->dehydrated(false)
                            ->afterStateHydrated(function ($state, $record, Forms\Set $set) {
                                if ($record) {
                                    $set('is_guest', $record->isGuest());
                                }
                            }),

                        // Registered customer field
                        Forms\Components\Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'name', fn ($query) => $query->where('role', 'customer'))
                            ->searchable()
                            ->preload()
                            ->visible(fn (Get $get) => !$get('is_guest'))
                            ->required(fn (Get $get) => !$get('is_guest')),

                        Forms\Components\Group::make([
                            Forms\Components\Placeholder::make('customer_phone')
                                ->label('Phone')
                                ->content(fn ($record) => $record?->customer?->phone ?? '—'),
                            Forms\Components\Placeholder::make('customer_email')
                                ->label('Email')
                                ->content(fn ($record) => $record?->customer?->email ?? '—'),
                            Forms\Components\Placeholder::make('customer_address')
                                ->label('Default Address')
                                ->content(fn ($record) => $record?->customer?->addresses?->firstWhere('is_default', true)?->address
                                    ?? $record?->customer?->addresses?->first()?->address
                                    ?? '—'),
                        ])
                            ->columns(2)
                            ->visible(fn (Get $get) => !$get('is_guest')),

                        // Guest fields
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('guest_name')
                                ->label('Guest Name')
                                ->required(fn (Get $get) => $get('is_guest'))
                                ->maxLength(255),
                            Forms\Components\TextInput::make('guest_phone')
                                ->label('Phone')
                                ->tel()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('guest_email')
                                ->label('Email')
                                ->email()
                                ->maxLength(255),
                            Forms\Components\Select::make('guest_contact_preference')
                                ->label('Contact Preference')
                                ->options([
                                    'phone' => 'Phone',
                                    'email' => 'Email',
                                    'whatsapp' => 'WhatsApp',
                                ]),
                        ])
                            ->visible(fn (Get $get) => $get('is_guest'))
                            ->columns(2),

                        Forms\Components\TextInput::make('guest_token')
                            ->label('Tracking Token')
                            ->disabled()
                            ->visible(fn ($record) => $record?->guest_token)
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('copyToken')
                                    ->icon('heroicon-o-clipboard')
                                    ->action(function ($state) {
                                        Notification::make()
                                            ->title('Tracking URL: ' . url("/track/{$state}"))
                                            ->success()
                                            ->send();
                                    })
                            ),
                    ])->columns(1),

                Forms\Components\Section::make('Service Details')
                    ->schema([
                        Forms\Components\Select::make('service_category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live(),
                        Forms\Components\Select::make('service_id')
                            ->label('Service')
                            ->relationship('service', 'name', fn ($query, $get) =>
                                $query->where('service_category_id', $get('service_category_id'))
                            )
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Location & Time')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('preferred_time'),
                        Forms\Components\DateTimePicker::make('scheduled_time'),
                    ])->columns(2),

                Forms\Components\Section::make('Assignment')
                    ->schema([
                        Forms\Components\Select::make('provider_id')
                            ->label('Assigned Provider')
                            ->relationship('provider', 'name', fn ($query) => $query->where('role', 'provider'))
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status')
                            ->options(collect(JobStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                            ->required()
                            ->default(JobStatus::Requested->value),
                    ])->columns(2),

                Forms\Components\Section::make('Workflow & Charges')
                    ->schema([
                        Forms\Components\Toggle::make('requires_site_visit')
                            ->label('Site visit / diagnosis required')
                            ->live(),
                        Forms\Components\TextInput::make('visit_charge_amount')
                            ->label('Visit Charge')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->minValue(0)
                            ->visible(fn (Get $get) => (bool) $get('requires_site_visit'))
                            ->helperText('Only charged when a visit or diagnosis is needed before the final quote.'),
                        Forms\Components\Toggle::make('urgent_requested')
                            ->label('Customer requested urgent support')
                            ->disabled(),
                        Forms\Components\TextInput::make('urgent_surcharge_amount')
                            ->label('Urgent Surcharge')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->minValue(0),
                    ])->columns(2),

                Forms\Components\Section::make('Admin Notes')
                    ->schema([
                        Forms\Components\Textarea::make('admin_notes')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('notify_customer_status_change')
                            ->label('Send SMS when status is changed from this edit page')
                            ->default(false)
                            ->dehydrated(false)
                            ->helperText('This is usually kept off unless you specifically want the customer notified immediately.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Attachments')
                    ->schema([
                        Forms\Components\ViewField::make('attachments_gallery')
                            ->view('filament.job-attachments'),
                        Forms\Components\FileUpload::make('new_attachments')
                            ->label('Upload more photos')
                            ->multiple()
                            ->image()
                            ->imagePreviewHeight('120')
                            ->panelLayout('grid')
                            ->disk('local')
                            ->directory(fn ($record) => 'tmp/requests/' . $record->id)
                            ->preserveFilenames()
                            ->dehydrated(false)
                            ->helperText('JPG/PNG/WEBP. Max 10MB each.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->label('Customer')
                    ->searchable(query: function ($query, string $search) {
                        $query->where(function ($q) use ($search) {
                            $q->whereHas('customer', fn ($q) => $q->where('name', 'like', "%{$search}%"))
                              ->orWhere('guest_name', 'like', "%{$search}%");
                        });
                    })
                    ->url(fn ($record) => $record->customer_id ? CustomerResource::getUrl('edit', ['record' => $record->customer_id]) : null)
                    ->description(fn ($record) => $record->isGuest() ? 'Guest' : 'Registered'),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Phone')
                    ->searchable(query: function ($query, string $search) {
                        $query->where(function ($q) use ($search) {
                            $q->whereHas('customer', fn ($customerQuery) => $customerQuery->where('phone', 'like', "%{$search}%"))
                                ->orWhere('guest_phone', 'like', "%{$search}%");
                        });
                    })
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->color(fn ($state) => $state->color()),
                Tables\Columns\TextColumn::make('provider.name')
                    ->placeholder('Unassigned')
                    ->sortable(),
                Tables\Columns\TextColumn::make('latestQuote.amount')
                    ->label('Quote')
                    ->formatStateUsing(function ($state, $record) {
                        $total = $record->latestQuote?->total;
                        $amount = $total !== null ? $total : $state;
                        return $amount !== null ? 'MVR ' . number_format((float) $amount, 2) : '—';
                    })
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('latestQuote.status')
                    ->label('Quote Status')
                    ->badge()
                    ->formatStateUsing(fn ($state, $record) => $record->latestQuote ? 'Quote Sent' : 'Not Sent')
                    ->color(fn ($state, $record) => $record->latestQuote ? 'info' : 'gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(JobStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()])),
                Tables\Filters\SelectFilter::make('service_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_guest')
                    ->label('Guest/Registered')
                    ->placeholder('All')
                    ->trueLabel('Guests only')
                    ->falseLabel('Registered only')
                    ->queries(
                        true: fn ($query) => $query->whereNull('customer_id'),
                        false: fn ($query) => $query->whereNotNull('customer_id'),
                    ),
                Tables\Filters\Filter::make('unassigned')
                    ->query(fn ($query) => $query->whereNull('provider_id'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),

                    // Copy tracking link (for guests)
                    Tables\Actions\Action::make('copyTrackingLink')
                        ->label('Copy Tracking Link')
                        ->icon('heroicon-o-link')
                        ->color('gray')
                        ->visible(fn ($record) => $record->guest_token)
                        ->action(function ($record) {
                            Notification::make()
                                ->title('Tracking URL')
                                ->body(url("/track/{$record->guest_token}"))
                                ->success()
                                ->send();
                        }),

                    // Create Quote Action
                    Tables\Actions\Action::make('sendQuote')
                        ->label('Create Quote')
                        ->icon('heroicon-o-document-currency-dollar')
                        ->color('info')
                        ->visible(fn ($record) => !$record->latestQuote)
                        ->form([
                            Forms\Components\Repeater::make('items')
                                ->label('Line Items')
                                ->schema([
                                    Forms\Components\TextInput::make('description')
                                        ->required()
                                        ->placeholder('Full service, pickup, tire change, etc.'),
                                Forms\Components\TextInput::make('amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('MVR')
                                    ->step(0.01),
                                ])
                                ->minItems(1)
                                ->defaultItems(1)
                                ->columns(2),
                            Forms\Components\Toggle::make('include_urgent_surcharge')
                                ->label('Add urgent surcharge')
                                ->helperText(fn ($record) => $record->urgent_requested
                                    ? 'Customer requested urgent service. Add MVR ' . number_format((float) ($record->urgent_surcharge_amount ?: BookingSetting::current()->urgent_surcharge_amount), 2) . ' if this quote should include it.'
                                    : 'This request was not marked urgent.')
                                ->default(false),
                            Forms\Components\Toggle::make('include_visit_charge')
                                ->label('Add visit / diagnosis charge')
                                ->helperText(fn ($record) => $record->visit_charge_amount
                                    ? 'Add the visit charge of MVR ' . number_format((float) $record->visit_charge_amount, 2) . ' to this quote if needed.'
                                    : 'No visit charge is attached to this request yet.')
                                ->default(false),
                            Forms\Components\Toggle::make('tax_enabled')
                                ->label('Apply Tax (8%)')
                                ->default(true),
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes for Customer')
                                ->rows(2),
                        ])
                        ->action(function ($record, array $data) {
                            $items = collect($data['items'] ?? [])
                                ->reject(fn ($item) => in_array($item['description'] ?? '', [
                                    'Urgent Support Surcharge',
                                    'Site Visit / Diagnosis Charge',
                                ], true))
                                ->values()
                                ->all();

                            if (! empty($data['include_urgent_surcharge']) && $record->urgent_requested) {
                                $items[] = [
                                    'description' => 'Urgent Support Surcharge',
                                    'amount' => (float) ($record->urgent_surcharge_amount ?: BookingSetting::current()->urgent_surcharge_amount),
                                ];
                            }

                            if (! empty($data['include_visit_charge']) && $record->visit_charge_amount) {
                                $items[] = [
                                    'description' => 'Site Visit / Diagnosis Charge',
                                    'amount' => (float) $record->visit_charge_amount,
                                ];
                            }

                            $taxEnabled = (bool) ($data['tax_enabled'] ?? false);

                            $quote = $record->quotes()->create([
                                'amount' => collect($items)->sum(fn ($item) => (float) ($item['amount'] ?? 0)),
                                'notes' => $data['notes'] ?? null,
                                'status' => 'sent',
                                'tax_enabled' => $taxEnabled,
                                'tax_rate' => 8.0,
                            ]);

                            $quote->items()->createMany($items);

                            $totals = $quote->recalculateTotals($items, $taxEnabled, 8.0);
                            $quote->update($totals);

                            $note = 'Quote sent: MVR ' . number_format($quote->total ?? $quote->amount, 2);

                            if ($record->status !== JobStatus::Quoted && $record->status !== JobStatus::Completed) {
                                $record->updateStatus(JobStatus::Quoted, $note, auth()->id());
                            } else {
                                $record->markCustomerUpdate();
                                $record->statusUpdates()->create([
                                    'status' => $record->status->value,
                                    'note' => $note,
                                    'user_id' => auth()->id(),
                                ]);
                            }
                            app(SmsNotifier::class)->sendQuoteReady($record->fresh(['customer', 'service', 'category']), $quote->fresh());
                            Notification::make()->title('Quote sent successfully')->success()->send();
                        }),
                    Tables\Actions\Action::make('viewQuote')
                        ->label('View Quote')
                        ->icon('heroicon-o-eye')
                        ->color('gray')
                        ->visible(fn ($record) => (bool) $record->latestQuote)
                        ->url(fn ($record) => route('quotes.pdf', $record->latestQuote), true),
                    Tables\Actions\Action::make('editQuote')
                        ->label('Update Quote')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning')
                        ->visible(fn ($record) => (bool) $record->latestQuote)
                        ->url(fn ($record) => JobQuoteResource::getUrl('edit', ['record' => $record->latestQuote])),

                    // Assign Provider Action
                    Tables\Actions\Action::make('assignProvider')
                        ->label('Assign Provider')
                        ->icon('heroicon-o-user-plus')
                        ->color('warning')
                        ->visible(fn ($record) => $record->status === JobStatus::Approved && !$record->provider_id)
                        ->form([
                            Forms\Components\Select::make('provider_id')
                                ->label('Provider')
                                ->options(User::where('role', 'provider')->pluck('name', 'id'))
                                ->required()
                                ->searchable(),
                            Forms\Components\DateTimePicker::make('scheduled_time')
                                ->label('Scheduled Time'),
                        ])
                        ->action(function ($record, array $data) {
                            $record->update([
                                'provider_id' => $data['provider_id'],
                                'scheduled_time' => $data['scheduled_time'] ?? null,
                            ]);
                            $record->updateStatus(JobStatus::Assigned, 'Provider assigned', auth()->id());
                            Notification::make()->title('Provider assigned successfully')->success()->send();
                        }),

                    Tables\Actions\Action::make('requestVisitCharge')
                        ->label('Require Visit Charge')
                        ->icon('heroicon-o-banknotes')
                        ->color('danger')
                        ->visible(fn ($record) => $record->status !== JobStatus::Completed && $record->status !== JobStatus::Cancelled)
                        ->form([
                            Forms\Components\TextInput::make('visit_charge_amount')
                                ->label('Visit / Diagnosis Charge')
                                ->numeric()
                                ->required()
                                ->prefix('MVR')
                                ->step(0.01)
                                ->default(fn () => BookingSetting::current()->visit_charge_amount),
                            Forms\Components\Textarea::make('note')
                                ->label('Customer Note')
                                ->rows(2)
                                ->default('A site visit is required before we can finalize your quotation.'),
                        ])
                        ->action(function ($record, array $data) {
                            $amount = (float) ($data['visit_charge_amount'] ?? BookingSetting::current()->visit_charge_amount);
                            $record->update([
                                'requires_site_visit' => true,
                                'visit_charge_amount' => $amount,
                            ]);

                            $note = trim(($data['note'] ?? '') . ' Visit charge: MVR ' . number_format($amount, 2));
                            $record->updateStatus(JobStatus::VisitChargeRequired, $note, auth()->id());

                            Notification::make()->title('Visit charge requested')->success()->send();
                        }),

                    Tables\Actions\Action::make('markVisitChargePaid')
                        ->label('Mark Visit Charge Paid')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $record->status === JobStatus::VisitChargeRequired)
                        ->form([
                            Forms\Components\Textarea::make('note')
                                ->label('Internal / Customer Note')
                                ->rows(2)
                                ->default('Visit charge payment received.'),
                        ])
                        ->action(function ($record, array $data) {
                            $record->updateStatus(JobStatus::VisitChargePaid, $data['note'] ?? 'Visit charge payment received.', auth()->id());
                            Notification::make()->title('Visit charge marked as paid')->success()->send();
                        }),

                    // Set Status Action
                    Tables\Actions\Action::make('setStatus')
                        ->label('Set Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('gray')
                        ->modalHeading('Update Status')
                        ->modalDescription('Choose the stage that best matches the real job flow. Add a short customer-facing note when helpful.')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->label('New Status')
                                ->options(collect(JobStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                                ->required(),
                            Forms\Components\Textarea::make('note')
                                ->label('Reason / Note')
                                ->rows(2)
                                ->required(),
                            Forms\Components\Toggle::make('notify_customer')
                                ->label('Send SMS to customer')
                                ->default(false)
                                ->helperText('Usually keep this off unless the customer needs to be notified right away.'),
                        ])
                        ->action(function ($record, array $data) {
                            $record->updateStatus(
                                JobStatus::from($data['status']),
                                $data['note'] ?? null,
                                auth()->id(),
                                (bool) ($data['notify_customer'] ?? false)
                            );
                            Notification::make()->title('Status updated successfully')->success()->send();
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobRequests::route('/'),
            'create' => Pages\CreateJobRequest::route('/create'),
            'edit' => Pages\EditJobRequest::route('/{record}/edit'),
        ];
    }
}
