<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterBuyerRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:buyers,email'],
            'mobile_number' => ['required', 'string', 'max:255', 'unique:buyers,mobile_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'فیلد نام الزامی است.',
            'name.string' => 'فیلد نام باید متن باشد.',
            'name.max' => 'طول فیلد نام نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.required' => 'فیلد ایمیل الزامی است.',
            'email.string' => 'فیلد ایمیل باید متن باشد.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'طول فیلد ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.unique' => 'ایمیل وارد شده قبلا استفاده شده است.',
            'mobile_number.required' => 'فیلد شماره موبایل الزامی است.',
            'mobile_number.string' => 'فیلد شماره موبایل باید متن باشد.',
            'mobile_number.max' => 'طول فیلد شماره موبایل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'mobile_number.unique' => 'شماره موبایل وارد شده قبلا استفاده شده است.',
            'password.required' => 'فیلد رمز عبور الزامی است.',
            'password.string' => 'فیلد رمز عبور باید متن باشد.',
            'password.min' => 'حداقل طول فیلد رمز عبور باید ۸ کاراکتر باشد.',
            'password.confirmed' => 'رمز عبور مطابقت ندارد.',
        ];
    }
}
