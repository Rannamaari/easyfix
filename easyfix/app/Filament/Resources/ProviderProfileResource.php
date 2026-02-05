<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderProfileResource\Pages;
use App\Models\ProviderProfile;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProviderProfileResource extends Resource
{
    protected static ?string $model = ProviderProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Providers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Account')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('User')
                            ->relationship('user', 'name', fn ($query) => $query->where('role', 'provider'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique('users', 'email'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->required()
                                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                                Forms\Components\Hidden::make('role')
                                    ->default('provider'),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return User::create($data)->id;
                            }),
                    ]),
                Forms\Components\Section::make('Profile Details')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('bio')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('profile_photo')
                            ->image()
                            ->directory('provider-photos'),
                        Forms\Components\Select::make('services')
                            ->relationship('services', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\TagsInput::make('service_areas')
                            ->placeholder('Add area'),
                    ])->columns(2),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_available')
                            ->default(true),
                        Forms\Components\Toggle::make('is_verified')
                            ->default(false),
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0)
                            ->maxValue(5)
                            ->default(0)
                            ->disabled(),
                        Forms\Components\TextInput::make('total_jobs')
                            ->numeric()
                            ->default(0)
                            ->disabled(),
                    ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('services.name')
                    ->badge()
                    ->limitList(2),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_jobs')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_available'),
                Tables\Filters\TernaryFilter::make('is_verified'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verify')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->is_verified)
                    ->action(fn ($record) => $record->update(['is_verified' => true])),
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
            'index' => Pages\ListProviderProfiles::route('/'),
            'create' => Pages\CreateProviderProfile::route('/create'),
            'edit' => Pages\EditProviderProfile::route('/{record}/edit'),
        ];
    }
}
