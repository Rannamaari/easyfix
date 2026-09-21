<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_charge_amount',
        'urgent_surcharge_amount',
        'ac_service_rates',
        'support_hotline',
        'micronet_bank_name',
        'micronet_account_name',
        'micronet_account_number',
        'sms_request_received_template',
        'sms_quote_ready_template',
        'sms_quote_updated_template',
        'sms_status_update_template',
        'sms_visit_charge_required_template',
        'sms_quote_approved_payment_template',
    ];

    protected $casts = [
        'visit_charge_amount' => 'decimal:2',
        'urgent_surcharge_amount' => 'decimal:2',
        'ac_service_rates' => 'array',
    ];

    public static function defaultAcServiceRates(): array
    {
        return [
            ['name' => 'AC Installation', 'price' => 1000, 'detail' => 'Installation support for your air conditioner.'],
            ['name' => 'AC Relocation', 'price' => 1250, 'detail' => 'Moving your AC to a new position or location.'],
            ['name' => 'Full Service (On-Site)', 'price' => 800, 'detail' => 'Full servicing at your home or workplace.'],
            ['name' => 'Full Service (Workshop)', 'price' => 1350, 'detail' => 'Workshop servicing when your unit needs more attention.'],
            ['name' => 'Gas Refill - Half', 'price' => 550, 'detail' => 'Refrigerant refill following assessment.'],
            ['name' => 'Gas Refill - Full', 'price' => 950, 'detail' => 'Full refill requirements confirmed during assessment.'],
            ['name' => 'Water Leak Fix', 'price' => 550, 'detail' => 'Troubleshooting and repair for a leaking AC.'],
            ['name' => 'Indoor Service', 'price' => 550, 'detail' => 'Service focused on the indoor unit.'],
            ['name' => 'AC Diagnosis', 'price' => 500, 'detail' => 'Find the fault before deciding on repair work.'],
        ];
    }

    public function acServiceRates(): array
    {
        return filled($this->ac_service_rates) ? $this->ac_service_rates : static::defaultAcServiceRates();
    }

    public static function current(): self
    {
        $defaults = [
            'visit_charge_amount' => 350,
            'urgent_surcharge_amount' => 500,
            'ac_service_rates' => static::defaultAcServiceRates(),
            'support_hotline' => '9996210',
            'micronet_account_name' => 'Micronet MVR',
            'micronet_account_number' => '7730000140010',
            'sms_request_received_template' => 'EasyFix: Your request has been submitted. Our team will call you soon. We may send a quote directly or arrange a site visit first. Check your dashboard: :url. For anything urgent, call :hotline.',
            'sms_quote_ready_template' => 'EasyFix: Your quote is ready. Total MVR :amount:includes_tax. Review it on your dashboard: :url. For anything urgent, call :hotline.',
            'sms_quote_updated_template' => 'EasyFix: Your quotation has been updated. New total MVR :amount:includes_tax. Please review and approve it again on your dashboard: :url. For anything urgent, call :hotline.',
            'sms_status_update_template' => 'EasyFix: Your request status is now :status.:note View update: :url. For anything urgent, call :hotline.',
            'sms_visit_charge_required_template' => 'EasyFix: Site visit required before final quotation. Visit charge: MVR :visit_charge. Bank: :bank_name. A/C Name: :account_name. A/C No: :account_number. After transfer, please send slip. View update: :url',
            'sms_quote_approved_payment_template' => 'EasyFix: Your quotation has been approved and is now an invoice. Total due MVR :amount. Please transfer to :account_name - Bank: :bank_name, A/C No: :account_number. Check your dashboard: :url. For anything urgent, call :hotline.',
        ];

        $setting = static::query()->firstOrCreate([], $defaults);
        $missing = [];

        foreach ($defaults as $key => $value) {
            if ($setting->{$key} === null || $setting->{$key} === '') {
                $missing[$key] = $value;
            }
        }

        if ($missing !== []) {
            $setting->forceFill($missing)->save();
            $setting->refresh();
        }

        return $setting;
    }

    public function smsTemplate(string $key): string
    {
        return match ($key) {
            'request_received' => (string) ($this->sms_request_received_template ?: ''),
            'quote_ready' => (string) ($this->sms_quote_ready_template ?: ''),
            'quote_updated' => (string) ($this->sms_quote_updated_template ?: ''),
            'status_update' => (string) ($this->sms_status_update_template ?: ''),
            'visit_charge_required' => (string) ($this->sms_visit_charge_required_template ?: ''),
            'quote_approved_payment' => (string) ($this->sms_quote_approved_payment_template ?: ''),
            default => '',
        };
    }
}
