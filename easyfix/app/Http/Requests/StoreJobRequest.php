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
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.min' => 'Please provide at least 10 characters describing your issue.',
            'attachments.max' => 'You can upload a maximum of 5 files.',
            'attachments.*.max' => 'Each file must be under 5MB.',
        ];
    }
}
