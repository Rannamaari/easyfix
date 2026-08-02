<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Customers';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'customer');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\Toggle::make('is_verified')
                            ->label('Email Verified')
                            ->helperText('Mark this user\'s email as verified')
                            ->dehydrated(false)
                            ->afterStateHydrated(fn ($component, $record) => $component->state($record?->email_verified_at !== null))
                            ->afterStateUpdated(function ($state, $record) {
                                if ($record) {
                                    $record->update([
                                        'email_verified_at' => $state ? now() : null,
                                    ]);
                                }
                            })
                            ->live(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Job Summary')
                    ->schema([
                        Forms\Components\Placeholder::make('total_jobs')
                            ->label('Total Jobs')
                            ->content(fn (?User $record) => $record ? $record->jobRequestsAsCustomer()->count() : '0'),
                        Forms\Components\Placeholder::make('open_jobs')
                            ->label('Open Jobs')
                            ->content(fn (?User $record) => $record ? $record->jobRequestsAsCustomer()->whereNotIn('status', ['completed', 'cancelled'])->count() : '0'),
                        Forms\Components\Placeholder::make('latest_job')
                            ->label('Latest Request')
                            ->content(function (?User $record) {
                                $job = $record?->jobRequestsAsCustomer()->latest()->first();

                                return $job ? "#{$job->id} · {$job->status->label()} · {$job->created_at->format('M d, Y g:i A')}" : 'No jobs yet';
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->visible(fn (?User $record) => filled($record)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer')
                    ->searchable(['name', 'username', 'email', 'phone'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Email Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('addresses')
                    ->label('Default Address')
                    ->formatStateUsing(function ($record) {
                        $addr = $record->addresses?->firstWhere('is_default', true)
                            ?? $record->addresses?->first();
                        if (!$addr) return '—';
                        return $addr->displayLabel() . ' — ' . $addr->address;
                    })
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jobRequestsAsCustomer_count')
                    ->label('Jobs')
                    ->counts('jobRequestsAsCustomer')
                    ->sortable(),
                Tables\Columns\TextColumn::make('latest_job_requested_at')
                    ->label('Latest Job')
                    ->state(fn (User $record) => $record->jobRequestsAsCustomer()->latest('created_at')->value('created_at'))
                    ->since()
                    ->sortable(false)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('verify')
                    ->label('Verify')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verify Email')
                    ->modalDescription('Mark this user\'s email as verified?')
                    ->visible(fn ($record) => is_null($record->email_verified_at))
                    ->action(fn ($record) => $record->update(['email_verified_at' => now()])),
                Tables\Actions\Action::make('viewJobs')
                    ->label('View Jobs')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->color('info')
                    ->url(fn (User $record) => static::getUrl('edit', ['record' => $record])),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'username',
            'email',
            'phone',
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\JobRequestsRelationManager::class,
            RelationManagers\SmsLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
