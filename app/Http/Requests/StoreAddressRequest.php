<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.string' => 'فیلد عنوان باید متن باشد.',
            'title.max' => 'طول فیلد عنوان نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'address.required' => 'فیلد آدرس الزامی است.',
            'address.string' => 'فیلد آدرس باید متن باشد.',
            'address.max' => 'طول فیلد آدرس نباید بیشتر از ۱۰۰۰ کاراکتر باشد.',
            'latitude.required' => 'فیلد عرض جغرافیایی الزامی است.',
            'latitude.numeric' => 'فیلد عرض جغرافیایی باید عددی باشد.',
            'longitude.required' => 'فیلد طول جغرافیایی الزامی است.',
            'longitude.numeric' => 'فیلد طول جغرافیایی باید عددی باشد.',
        ];
    }
}
