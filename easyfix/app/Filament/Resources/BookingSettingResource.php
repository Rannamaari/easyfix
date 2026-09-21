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

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'AC Prices & Booking';

    /**
     * EasyFix has one shared settings record, so the sidebar should open its
     * editor directly rather than making admins first find and edit that row.
     */
    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => BookingSetting::current()]);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('AC Public Rates')
                ->description('These prices appear on the public AC services page. Changes are live as soon as you save.')
                ->schema([
                    Forms\Components\Repeater::make('ac_service_rates')
                        ->label('AC Services and Prices')
                        ->default(fn () => BookingSetting::defaultAcServiceRates())
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Service name')
                                ->required()
                                ->maxLength(100),
                            Forms\Components\TextInput::make('price')
                                ->label('Public rate')
                                ->numeric()
                                ->required()
                                ->prefix('MVR')
                                ->step(0.01)
                                ->minValue(0),
                            Forms\Components\TextInput::make('detail')
                                ->label('Short description')
                                ->required()
                                ->maxLength(180)
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->addActionLabel('Add AC service rate')
                        ->reorderableWithButtons()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ]),
            Forms\Components\Section::make('Booking Charges')
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
            Forms\Components\Section::make('Payment Details')
                ->description('Used in payment-related SMS messages sent to customers.')
                ->schema([
                    Forms\Components\TextInput::make('support_hotline')
                        ->label('Support Hotline')
                        ->tel()
                        ->required(),
                    Forms\Components\TextInput::make('micronet_bank_name')
                        ->label('Micronet Bank Name'),
                    Forms\Components\TextInput::make('micronet_account_name')
                        ->label('Micronet Account Name')
                        ->required(),
                    Forms\Components\TextInput::make('micronet_account_number')
                        ->label('Micronet Account Number')
                        ->required(),
                ])->columns(2),
            Forms\Components\Section::make('SMS Templates')
                ->description('Editable SMS content. Use the supported placeholders shown below each field.')
                ->schema([
                    Forms\Components\Textarea::make('sms_request_received_template')
                        ->label('Request Received SMS')
                        ->rows(3)
                        ->required()
                        ->helperText('Placeholders: :url, :hotline'),
                    Forms\Components\Textarea::make('sms_quote_ready_template')
                        ->label('Quote Ready SMS')
                        ->rows(3)
                        ->required()
                        ->helperText('Placeholders: :amount, :includes_tax, :url, :hotline'),
                    Forms\Components\Textarea::make('sms_quote_updated_template')
                        ->label('Quote Updated SMS')
                        ->rows(3)
                        ->required()
                        ->helperText('Placeholders: :amount, :includes_tax, :url, :hotline'),
                    Forms\Components\Textarea::make('sms_status_update_template')
                        ->label('Generic Status Update SMS')
                        ->rows(3)
                        ->required()
                        ->helperText('Placeholders: :status, :note, :url, :hotline'),
                    Forms\Components\Textarea::make('sms_visit_charge_required_template')
                        ->label('Visit Charge Required SMS')
                        ->rows(4)
                        ->required()
                        ->helperText('Placeholders: :visit_charge, :bank_name, :account_name, :account_number, :url'),
                    Forms\Components\Textarea::make('sms_quote_approved_payment_template')
                        ->label('Quote Approved / Invoice SMS')
                        ->rows(4)
                        ->required()
                        ->helperText('Placeholders: :amount, :bank_name, :account_name, :account_number, :url, :hotline'),
                ]),
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
                Tables\Columns\TextColumn::make('support_hotline')
                    ->label('Hotline')
                    ->toggleable(),
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
