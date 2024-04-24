<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:food_categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'ingredients' => ['nullable', 'string'],
            'image' => ['nullable', 'image','mimes:jpeg,png,jpg', 'max:2048'],
            'discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام غذا الزامی است.',
            'name.string' => 'نام غذا باید به صورت متنی باشد.',
            'name.max' => 'نام غذا نباید بیشتر از 255 کاراکتر باشد.',
            'category_id.required' => 'دسته بندی غذا الزامی است.',
            'category_id.exists' => 'دسته بندی غذا معتبر نیست.',
            'price.required' => 'قیمت غذا الزامی است.',
            'price.numeric' => 'قیمت غذا باید عددی باشد.',
            'price.min' => 'قیمت غذا نباید کمتر از صفر باشد.',
            'ingredients.string' => 'مواد غذایی باید  به صورت متنی باشند.',
            'image.image' => 'فایل باید یک تصویر باشد.',
            'image.mimes' => 'فایل باید با فرمت‌های jpeg، png یا jpg باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از 2MB باشد.',
        ];
    }
}
