<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $buyerId = Auth::id();

        $addresses = Address::where('buyer_id', $buyerId)->get();

        return AddressResource::collection($addresses);
    }

    public function store(StoreAddressRequest $request)
    {
        $buyer = Auth::user();

        $address = $buyer->addresses()->create($request->validated());

        return response()->json(['msg' => __('response.buyer.address_added')], 201);
    }

    public function setCurrent(Request $request, Address $address): JsonResponse
    {

        if ($address->buyer_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access to the address'], 403);
        }

        Address::where('buyer_id', Auth::id())->update(['is_current' => false]);

        // Set the current address
        $address->is_current = true;
        $address->save();

        return response()->json(['msg' => __('response.buyer.set_current_address')]);
    }

}
