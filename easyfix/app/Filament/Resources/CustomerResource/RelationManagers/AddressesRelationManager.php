<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    protected static ?string $title = 'Addresses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('label')
                    ->options([
                        'home' => 'Home',
                        'work' => 'Work',
                        'other' => 'Other',
                    ])
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('custom_label')
                    ->label('Custom Label')
                    ->placeholder('e.g. Parents\' house, Vacation home')
                    ->maxLength(50)
                    ->required(fn (Forms\Get $get) => $get('label') === 'other')
                    ->visible(fn (Forms\Get $get) => $get('label') === 'other'),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_default')
                    ->label('Default Address'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Type')
                    ->formatStateUsing(fn ($record) => $record->displayLabel())
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'home' => 'success',
                        'work' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('address')
                    ->wrap()
                    ->limit(80),
                Tables\Columns\IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
