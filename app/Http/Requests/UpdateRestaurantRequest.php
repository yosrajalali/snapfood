<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category_id' => ['required', 'integer', 'exists:restaurant_categories,id'],
            'address' => 'required|string|max:1000',
            'bank_account_number' => 'nullable|string|max:255',
            'delivery_cost' => 'nullable|numeric',
            'operational_hours' => 'array',
            'image' => 'nullable|image|max:2048',
            'is_open' => 'required|boolean'
        ];
    }
}
