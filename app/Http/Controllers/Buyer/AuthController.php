<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginBuyerRequest;
use App\Http\Requests\RegisterBuyerRequest;
use App\Http\Requests\UpdateBuyerProfileRequest;
use App\Http\Resources\BuyerResource;
use App\Models\Buyer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // User registration
    public function register(RegisterBuyerRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $buyer = Buyer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile_number' => $validated['mobile_number'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $buyer->createToken('Auth Token')->plainTextToken;

        return response()->json([
            'data' => [
                'message' => __('response.buyer.register'),
                'token' => $token
            ]
        ], 201);
    }


    public function login(LoginBuyerRequest $request)
    {
        $validated = $request->validated();
        $buyer = Buyer::where('email', $validated['email'])->first();

        if (!$buyer || !Hash::check($validated['password'], $buyer->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $buyer->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'data' => [
                'message' => __('response.buyer.login'),
                'token' => $token
            ]
        ]);
    }

    public function updateProfile(UpdateBuyerProfileRequest $request)
    {
        $user = Auth::guard('buyer')->user();

        $user->update($request->validated());

        return response()->json([
            'message' => __('response.buyer.update_profile'),
            'data' => new BuyerResource($user),
        ]);
    }

}
