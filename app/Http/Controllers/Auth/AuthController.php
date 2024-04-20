<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(UserRegistrationRequest $request, $guard)
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone_number' => $validated['phone_number'],
            'role' => $guard,
        ]);

        if ($guard === 'buyer') {
            $token = $user->createToken('apiToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            Auth::login($user);
            return redirect()->route('home');
        }
    }
}
