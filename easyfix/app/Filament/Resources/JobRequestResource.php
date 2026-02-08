<?php

namespace App\Filament\Resources;

use App\Enums\JobStatus;
use App\Filament\Resources\JobRequestResource\Pages;
use App\Models\JobRequest;
use App\Models\User;
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

                Forms\Components\Section::make('Admin Notes')
                    ->schema([
                        Forms\Components\Textarea::make('admin_notes')
                            ->rows(2)
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
                    ->description(fn ($record) => $record->isGuest() ? 'Guest' : 'Registered'),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Phone')
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
                            Forms\Components\Toggle::make('tax_enabled')
                                ->label('Apply Tax (8%)')
                                ->default(true),
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes for Customer')
                                ->rows(2),
                        ])
                        ->action(function ($record, array $data) {
                            $items = $data['items'] ?? [];
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
                                $record->statusUpdates()->create([
                                    'status' => $record->status->value,
                                    'note' => $note,
                                    'user_id' => auth()->id(),
                                ]);
                            }
                            Notification::make()->title('Quote sent successfully')->success()->send();
                        }),
                    Tables\Actions\Action::make('viewQuote')
                        ->label('View Quote')
                        ->icon('heroicon-o-eye')
                        ->color('gray')
                        ->visible(fn ($record) => (bool) $record->latestQuote)
                        ->url(fn ($record) => route('quotes.pdf', $record->latestQuote), true),

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

                    // Set Status Action
                    Tables\Actions\Action::make('setStatus')
                        ->label('Set Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('gray')
                        ->requiresConfirmation()
                        ->modalHeading('Update Status')
                        ->modalDescription('Status changes should follow the normal flow. Use override only when necessary, and provide a reason.')
                        ->form([
                            Forms\Components\Toggle::make('override')
                                ->label('Override transition rules')
                                ->default(false)
                                ->helperText('Use only if you need to skip steps.'),
                            Forms\Components\Select::make('status')
                                ->label('New Status')
                                ->options(function (Get $get, $record) {
                                    $current = $record?->status;
                                    $override = $get('override');

                                    if (!$current || $override) {
                                        return collect(JobStatus::cases())
                                            ->mapWithKeys(fn ($status) => [$status->value => $status->label()]);
                                    }

                                    return collect(JobStatus::cases())
                                        ->filter(fn ($status) => $current->canTransitionTo($status))
                                        ->mapWithKeys(fn ($status) => [$status->value => $status->label()]);
                                })
                                ->required(),
                            Forms\Components\Textarea::make('note')
                                ->label('Reason / Note')
                                ->rows(2)
                                ->required(),
                        ])
                        ->action(function ($record, array $data) {
                            $override = (bool) ($data['override'] ?? false);
                            $newStatus = JobStatus::from($data['status']);

                            if (!$override && !$record->status->canTransitionTo($newStatus)) {
                                Notification::make()
                                    ->title('Invalid transition')
                                    ->body('Please follow the normal status flow or enable override with a reason.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            $record->updateStatus(JobStatus::from($data['status']), $data['note'] ?? null, auth()->id());
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
