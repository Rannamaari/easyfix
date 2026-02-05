<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobQuoteResource\Pages;
use App\Models\JobQuote;
use App\Models\JobRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobQuoteResource extends Resource
{
    protected static ?string $model = JobQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?int $navigationSort = 2;

    public static function canViewNavigation(): bool
    {
        $user = auth()->user();

        return $user && $user->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Quote Details')
                    ->schema([
                        Forms\Components\Select::make('job_request_id')
                            ->label('Job Request')
                            ->relationship('jobRequest', 'id')
                            ->getOptionLabelFromRecordUsing(fn (JobRequest $record) => "#{$record->id} - {$record->contact_name}")
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('MVR')
                            ->step(0.01)
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Calculated from line items.'),
                        Forms\Components\Repeater::make('items')
                            ->label('Line Items')
                            ->relationship()
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
                            ->columns(2)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('tax_enabled')
                            ->label('Apply Tax (8%)')
                            ->default(true),
                        Forms\Components\Select::make('status')
                            ->options([
                                'sent' => 'Sent',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('subtotal')
                            ->prefix('MVR')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('tax_amount')
                            ->prefix('MVR')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('total')
                            ->prefix('MVR')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Approved At')
                            ->seconds(false)
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\DateTimePicker::make('rejected_at')
                            ->label('Rejected At')
                            ->seconds(false)
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jobRequest.id')
                    ->label('Job #')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jobRequest.contact_name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->formatStateUsing(function ($state, $record) {
                        $amount = $record->total ?? $state;
                        return $amount !== null ? 'MVR ' . number_format((float) $amount, 2) : '—';
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => match ($state) {
                        'sent' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'sent' => 'Sent',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListJobQuotes::route('/'),
            'create' => Pages\CreateJobQuote::route('/create'),
            'edit' => Pages\EditJobQuote::route('/{record}/edit'),
        ];
    }
}
