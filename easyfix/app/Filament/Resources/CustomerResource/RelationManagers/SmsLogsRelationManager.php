<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SmsLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'smsLogs';

    protected static ?string $title = 'SMS History';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'sent' => 'success',
                        'dry_run' => 'info',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('destination'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Message')
                    ->limit(80)
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([])
            ->actions([
                Tables\Actions\Action::make('viewLog')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => \App\Filament\Resources\SmsLogResource::getUrl('view', ['record' => $record])),
            ])
            ->bulkActions([]);
    }
}
