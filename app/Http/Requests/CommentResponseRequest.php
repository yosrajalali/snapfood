<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentResponseRequest extends FormRequest
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
            'response' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'response.required' => 'پاسخ نظر الزامی است.',
            'response.string' => 'پاسخ نظر باید از نوع رشته باشد.',
            'response.max' => 'پاسخ نظر نباید بیشتر از ۵۰۰ کاراکتر باشد.',
        ];
    }
}
