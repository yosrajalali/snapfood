<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $user = User::where('email', $request->email)->first();
        $guard = 'admin'; // Assuming 'admin' is the default guard for Users

        // If no user found, check Sellers
        if (!$user) {
            $user = Seller::where('email', $request->email)->first();
            $guard = 'seller'; // Change this as per your guard configuration
        }

        // Check if we have a user and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard($guard)->login($user);
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', __('response.login.success'));
        }

        // If authentication fails, return back with an error
        return back()->withErrors(['error' => __('response.login.failed')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
