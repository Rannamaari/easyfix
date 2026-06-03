<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SmsLogResource\Pages;
use App\Models\SmsLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SmsLogResource extends Resource
{
    protected static ?string $model = SmsLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Communications';

    protected static ?string $navigationLabel = 'SMS Logs';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('SMS Details')
                ->schema([
                    Forms\Components\TextInput::make('destination')->disabled(),
                    Forms\Components\TextInput::make('type')->disabled(),
                    Forms\Components\TextInput::make('status')->disabled(),
                    Forms\Components\TextInput::make('source')->disabled(),
                    Forms\Components\TextInput::make('provider_transaction_id')
                        ->label('Provider Transaction ID')
                        ->disabled(),
                    Forms\Components\Textarea::make('content')
                        ->rows(5)
                        ->disabled()
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('error_message')
                        ->rows(3)
                        ->disabled()
                        ->columnSpanFull(),
                    Forms\Components\KeyValue::make('meta')
                        ->disabled()
                        ->columnSpanFull(),
                    Forms\Components\KeyValue::make('provider_response')
                        ->disabled()
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destination')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jobRequest.id')
                    ->label('Job #')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'sent' => 'success',
                        'dry_run' => 'info',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('content')
                    ->label('Message')
                    ->limit(70)
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'sent' => 'Sent',
                        'dry_run' => 'Dry Run',
                        'failed' => 'Failed',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options(fn () => SmsLog::query()
                        ->whereNotNull('type')
                        ->distinct()
                        ->orderBy('type')
                        ->pluck('type', 'type')
                        ->all()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSmsLogs::route('/'),
            'view' => Pages\ViewSmsLog::route('/{record}'),
        ];
    }
}
