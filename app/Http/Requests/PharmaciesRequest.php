<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmaciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[
            'pharmacy_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'license_number' => 'required|string|max:100',
            'license_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'commercial_number' => 'required|string|max:100',
            'national_id_number' => 'required|string|max:100',
            'expiration_date' => 'required|date|after:today',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i|after:opening_time',
            'is_24_hours' => 'boolean',
            'is_delivery' => 'boolean',
        ];
    }
}
