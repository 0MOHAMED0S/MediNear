<?php

namespace App\Http\Requests\Api\Admin\Medicines;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateMedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    // Change 'id' to 'medicine' to match your route:list output
    $medicineId = $this->route('medicine');

    if (!\App\Models\Medicine::where('id', $medicineId)->exists()) {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Medicine not found.'
            ], 404)
        );
    }

    return true;
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
$medicineId = $this->route('medicine');

    return [
        'name' => [
            'sometimes',
            'required',
            'string',
            'min:3',
            'max:255',
            Rule::unique('medicines', 'name')->ignore($medicineId),
        ],
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'sometimes|nullable|string|min:5|max:1000',
            'status' => 'sometimes|required|boolean',
            'category_id' => 'sometimes|required|exists:categories,id',
            'manufacturer' => 'sometimes|nullable|string|min:2|max:255',
            'barcode' => [
                'sometimes',
                'nullable',
                'string',
                'min:3',
                'max:50',
                Rule::unique('medicines', 'barcode')->ignore($medicineId),
            ],
        ];
    }

    /**
     * Custom messages for validation errors.
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
            'image.mimes' => 'Image must be jpeg, png, jpg, gif, or webp.',
            'image.max' => 'Image size cannot exceed 2MB.',

            'description.string' => 'Description must be a valid string.',
            'description.min' => 'Description must be at least :min characters.',
            'description.max' => 'Description cannot exceed :max characters.',

            'status.required' => 'Status is required.',
            'status.boolean' => 'Status must be true or false.',

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
