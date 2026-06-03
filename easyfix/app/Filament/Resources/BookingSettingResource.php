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
