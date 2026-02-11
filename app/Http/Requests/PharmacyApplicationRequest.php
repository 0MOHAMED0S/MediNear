<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'pharmacy_name' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',

        'phone_number' => 'required|string',

        'address' => 'required|string',

        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',

        'license_number' => 'required|string',
        'license_image' => 'required|string',

        'commercial_number' => 'required|string|unique:pharmacy_applications,commercial_number',

        'national_id_number' => 'required|string',

        'expiration_date' => 'required|date',

        'is_24_hours' => 'required|boolean',

        'opening_time' => 'nullable|required_if:is_24_hours,false|date_format:H:i',
        'closing_time' => 'nullable|required_if:is_24_hours,false|date_format:H:i',

        'is_delivery' => 'boolean',
    ];
}
}
