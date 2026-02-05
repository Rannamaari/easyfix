<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobUpdateRequestResource\Pages;
use App\Models\JobRequest;
use App\Models\JobUpdateRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobUpdateRequestResource extends Resource
{
    protected static ?string $model = JobUpdateRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Request')
                    ->schema([
                        Forms\Components\Select::make('job_request_id')
                            ->label('Job Request')
                            ->relationship('jobRequest', 'id')
                            ->getOptionLabelFromRecordUsing(fn (JobRequest $record) => "#{$record->id} - {$record->contact_name}")
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'open' => 'Open',
                                'responded' => 'Responded',
                                'closed' => 'Closed',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('message')
                            ->label('Request Message')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Response')
                    ->schema([
                        Forms\Components\Textarea::make('response')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('responded_by_user_id')
                            ->label('Responded By')
                            ->options(User::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                        Forms\Components\DateTimePicker::make('responded_at')
                            ->seconds(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jobRequest.id')
                    ->label('Job #')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jobRequest.contact_name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => match ($state) {
                        'open' => 'warning',
                        'responded' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('responded_at')
                    ->dateTime()
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Open',
                        'responded' => 'Responded',
                        'closed' => 'Closed',
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
            'index' => Pages\ListJobUpdateRequests::route('/'),
            'create' => Pages\CreateJobUpdateRequest::route('/create'),
            'edit' => Pages\EditJobUpdateRequest::route('/{record}/edit'),
        ];
    }
}
