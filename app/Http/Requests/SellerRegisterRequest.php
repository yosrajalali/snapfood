<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SellerRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sellers'],
            'phone_number' => ['required', 'string', 'max:255','regex:/^09\d{9}$/', 'unique:sellers'] ,
            'password' => ['required', 'string', 'min:8', 'confirmed',],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.string' => 'نام باید از نوع متن باشد.',
            'name.min' => 'نام باید حداقل ۴ کاراکتر باشد.',
            'name.max' => 'نام نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.string' => 'ایمیل باید از نوع متن باشد.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.unique' => 'ایمیل وارد شده قبلاً ثبت شده است.',
            'phone_number.required' => 'وارد کردن شماره تلفن الزامی است.',
            'phone_number.string' => 'شماره تلفن باید از نوع متن باشد.',
            'phone_number.regex' => 'شماره تلفن باید با فرمت موبایل ایران (۰۹xx xxx xxxx) باشد.',
            'phone_number.unique' => 'شماره تلفن وارد شده قبلاً ثبت شده است.',
            'password.required' => 'وارد کردن رمز عبور الزامی است.',
            'password.string' => 'رمز عبور باید از نوع متن باشد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'رمزهای عبور وارد شده مطابقت ندارند.',
            'password.regex' => 'پسورد نمیتواند شامل حروف فارسی یا فضای خالی باشد.'
        ];
    }
}
