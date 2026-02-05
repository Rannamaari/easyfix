<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreGuestJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_username' => ['nullable', 'string', 'max:50'],
            'guest_phone' => ['nullable', 'string', 'max:20'],
            'guest_email' => ['nullable', 'email', 'max:255'],
            'guest_contact_preference' => ['nullable', 'in:phone,email,whatsapp'],
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time_slot' => ['nullable', 'string', 'max:10'],
            'preferred_time' => ['nullable', 'date', 'after:now'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (empty($this->guest_phone) && empty($this->guest_email)) {
                    $validator->errors()->add('guest_phone', 'Please provide at least a phone number or email address.');
                }
            },
        ];
    }

    public function messages(): array
    {
        return [
            'guest_name.required' => 'Please provide your name.',
            'description.min' => 'Please provide at least 10 characters describing your issue.',
            'attachments.max' => 'You can upload a maximum of 5 files.',
            'attachments.*.max' => 'Each file must be under 5MB.',
        ];
    }
}
