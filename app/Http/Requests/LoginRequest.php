<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
        ];

        // Determine if a password should be required based on the user type associated with the email
        if ($this->needsPassword($this->email)) {
            $rules['password'] = ['required', 'string', 'min:8'];
        } else {
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }

        return $rules;
    }

    private function needsPassword($email): bool
    {
        // Example logic, assuming you have a User model and users have a 'role' attribute
        $user = \App\Models\User::where('email', $email)->first();
        return $user && $user->role !== 'buyer';  // Password is not required if the role is 'buyer'
    }
}
