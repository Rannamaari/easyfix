<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingSettingResource\Pages;
use App\Models\BookingSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingSettingResource extends Resource
{
    protected static ?string $model = BookingSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Booking Settings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Charges')
                ->description('Control the default service-request surcharges used in the customer booking flow.')
                ->schema([
                    Forms\Components\TextInput::make('visit_charge_amount')
                        ->label('Site Visit / Diagnosis Charge')
                        ->numeric()
                        ->required()
                        ->prefix('MVR')
                        ->step(0.01)
                        ->minValue(0),
                    Forms\Components\TextInput::make('urgent_surcharge_amount')
                        ->label('Urgent Response Surcharge (within 1 hour)')
                        ->numeric()
                        ->required()
                        ->prefix('MVR')
                        ->step(0.01)
                        ->minValue(0),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visit_charge_amount')
                    ->label('Visit Charge')
                    ->money('MVR', divideBy: 1),
                Tables\Columns\TextColumn::make('urgent_surcharge_amount')
                    ->label('Urgent Surcharge')
                    ->money('MVR', divideBy: 1),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->label('Updated'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingSettings::route('/'),
            'edit' => Pages\EditBookingSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return ! BookingSetting::query()->exists();
    }
}
