<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'specific_issue' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'address_mode' => ['required', 'in:saved,new'],
            'address_id' => ['required_if:address_mode,saved', 'nullable', 'exists:user_addresses,id'],
            'new_address_label' => ['required_if:address_mode,new', 'in:home,work,other'],
            'new_address' => ['required_if:address_mode,new', 'string', 'max:500'],
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
            'description.min' => 'Please provide at least 10 characters describing your issue.',
            'photos.max' => 'You can upload a maximum of 5 photos.',
            'photos.*.max' => 'Each photo must be under 10MB.',
        ];
    }
}
