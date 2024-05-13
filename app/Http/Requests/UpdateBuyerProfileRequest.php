<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBuyerProfileRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:buyers,email,' . $this->user()->id],
            'mobile_number' => ['string', 'unique:buyers,mobile_number,' . $this->user()->id],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'فیلد نام باید متن باشد.',
            'name.max' => 'طول فیلد نام نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.string' => 'فیلد ایمیل باید متن باشد.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email.max' => 'طول فیلد ایمیل نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.unique' => 'ایمیل وارد شده قبلا استفاده شده است.',
            'mobile_number.string' => 'فیلد شماره موبایل باید متن باشد.',
            'mobile_number.unique' => 'شماره موبایل وارد شده قبلا استفاده شده است.',
        ];
    }
}
