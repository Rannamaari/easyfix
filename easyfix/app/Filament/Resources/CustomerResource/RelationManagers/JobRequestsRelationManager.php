<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class JobRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'jobRequestsAsCustomer';

    protected static ?string $title = 'Requested Jobs';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Job #')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->wrap()
                    ->limit(60),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->color(fn ($state) => $state->color()),
                Tables\Columns\TextColumn::make('latestQuote.total')
                    ->label('Quote')
                    ->formatStateUsing(function ($state, $record) {
                        $amount = $record->latestQuote?->total ?? $record->latestQuote?->amount;

                        return $amount ? 'MVR ' . number_format((float) $amount, 2) : '—';
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Requested')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([])
            ->actions([
                Tables\Actions\Action::make('openJob')
                    ->label('Open Job')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => \App\Filament\Resources\JobRequestResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\Action::make('editQuote')
                    ->label('Edit Quote')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->visible(fn ($record) => (bool) $record->latestQuote)
                    ->url(fn ($record) => \App\Filament\Resources\JobQuoteResource::getUrl('edit', ['record' => $record->latestQuote])),
            ])
            ->bulkActions([]);
    }
}
