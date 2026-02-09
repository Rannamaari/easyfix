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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer')
                    ->searchable()
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
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
