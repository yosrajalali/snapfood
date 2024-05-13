<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginBuyerRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'فیلد ایمیل الزامی است.',
            'email.string' => 'فیلد ایمیل باید متن باشد.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'طول فیلد ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'password.required' => 'فیلد رمز عبور الزامی است.',
            'password.string' => 'فیلد رمز عبور باید متن باشد.',
            'password.min' => 'حداقل طول فیلد رمز عبور باید ۸ کاراکتر باشد.',
        ];
    }
}
