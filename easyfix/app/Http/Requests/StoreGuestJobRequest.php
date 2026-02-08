<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'guest_phone' => ['required', 'string', 'max:20'],
            'guest_email' => ['required', 'email', 'max:255'],
            'guest_contact_preference' => ['nullable', 'in:phone,email,whatsapp'],
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'specific_issue' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time_slot' => ['nullable', 'string', 'max:10'],
            'preferred_time' => ['nullable', 'date', 'after:now'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'captions' => ['nullable', 'array', 'max:5'],
            'captions.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'guest_name.required' => 'Please provide your name.',
            'guest_phone.required' => 'Please provide your phone number.',
            'guest_email.required' => 'Please provide your email address.',
            'description.min' => 'Please provide at least 10 characters describing your issue.',
            'photos.max' => 'You can upload a maximum of 5 photos.',
            'photos.*.max' => 'Each photo must be under 10MB.',
        ];
    }
}
