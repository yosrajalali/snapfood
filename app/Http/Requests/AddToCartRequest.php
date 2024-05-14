<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'food_id' => ['required', 'exists:food,id'],
            'count' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'food_id.required' => 'فیلد شناسه غذا الزامی است.',
            'food_id.exists' => 'شناسه غذا وارد شده معتبر نیست.',
            'count.required' => 'فیلد تعداد الزامی است.',
            'count.integer' => 'فیلد تعداد باید عددی صحیح باشد.',
            'count.min' => 'حداقل تعداد باید ۱ باشد.',
        ];
    }
}
