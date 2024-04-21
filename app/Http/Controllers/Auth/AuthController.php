<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
            'password' => $guard === 'seller' ? Hash::make($validated['password']) : null,
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

    public function login(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $email = $request->email;
        $password = $request->password;

        // Check if a password is provided
        if (!empty($password)) {
            // This is an admin or seller trying to log in
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }
        } else {
            // This is a buyer trying to log in
            if ($user = User::authenticateBuyer($email)) {
                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 200);
            }
        }

        return back()->withErrors(['error' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        $guard = Auth::guard(); // Get the default guard

        if ($guard->check()) {
            $guard->logout();

            // Invalidate the session to protect against session fixation attacks
            $request->session()->invalidate();

            // Regenerate the session token
            $request->session()->regenerateToken();
        }

        return redirect()->route('auth.login.form');
    }

}
