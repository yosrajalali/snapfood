<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRestaurantRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^09\d{9}$/', 'unique:restaurants'],
            'address' => ['required', 'string'],
            'bank_account_number' => ['required', 'string','min:12', 'max:16'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'فیلد نام رستوران الزامی است.',
            'name.string' => 'فیلد نام رستوران باید به صورت متنی باشد.',
            'name.max' => 'طول نام رستوران نباید بیشتر از 255 کاراکتر باشد.',
            'type.required' => 'فیلد نوع رستوران الزامی است.',
            'type.string' => 'فیلد نوع رستوران باید به صورت متنی باشد.',
            'type.max' => 'طول نوع رستوران نباید بیشتر از 255 کاراکتر باشد.',
            'phone_number.required' => 'فیلد شماره تماس الزامی است.',
            'phone_number.string' => 'فیلد شماره تماس باید عددی باشد.',
            'phone_number.regex' => 'فرمت شماره تماس صحیح نیست. (مثال: 09123456789)',
            'phone_number.unique' => 'شماره تماس وارد شده قبلا استفاده شده است.',
            'address.required' => 'فیلد آدرس الزامی است.',
            'address.string' => 'فیلد آدرس باید به صورت متنی باشد.',
            'bank_account_number.required' => 'فیلد شماره حساب الزامی است.',
            'bank_account_number.string' => 'فیلد شماره حساب باید به صورت عددی باشد.',
            'bank_account_number.min' => 'طول شماره حساب نباید کمتر از 12 کاراکتر باشد.',
            'bank_account_number.max' => 'طول شماره حساب نباید بیشتر از 16 کاراکتر باشد.',
        ];
    }
}
