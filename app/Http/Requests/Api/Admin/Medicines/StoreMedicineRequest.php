<?php

namespace App\Http\Requests\Api\Admin\Medicines;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreMedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add custom authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:medicines,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // max 2MB
            'description' => 'nullable|string|min:5|max:1000',
            'category_id' => 'required|exists:categories,id',
            'manufacturer' => 'nullable|string|min:2|max:255',
            'barcode' => 'nullable|string|unique:medicines,barcode|min:3|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Medicine name is required.',
            'name.string' => 'Medicine name must be a valid string.',
            'name.min' => 'Medicine name must be at least :min characters.',
            'name.max' => 'Medicine name cannot exceed :max characters.',
            'name.unique' => 'Medicine name already exists.',

            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be one of the following types: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Image size cannot exceed 2MB.',

            'description.string' => 'Description must be a valid string.',
            'description.min' => 'Description must be at least :min characters.',
            'description.max' => 'Description cannot exceed :max characters.',

            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',

            'manufacturer.string' => 'Manufacturer must be a valid string.',
            'manufacturer.min' => 'Manufacturer must be at least :min characters.',
            'manufacturer.max' => 'Manufacturer cannot exceed :max characters.',

            'barcode.string' => 'Barcode must be a valid string.',
            'barcode.unique' => 'This barcode already exists.',
            'barcode.min' => 'Barcode must be at least :min characters.',
            'barcode.max' => 'Barcode cannot exceed :max characters.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => 'Data verification failed',
            'errors'  => $validator->errors()
        ], 422));
    }
}
