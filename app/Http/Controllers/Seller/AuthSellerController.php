<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRegisterRequest;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class AuthSellerController extends Controller
{
    public function showRegister(): View
    {
        return view('seller.register');
    }

    public function register(SellerRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $seller= Seller::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
        ]);

        //login the seller
        Auth::guard('seller')->login($seller);

        return redirect()->route('home')->with('success', __('response.register.success'));
    }
}
