<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProfileRequest;
use App\Http\Requests\UserPurchaseRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createProfile(CreateUserProfileRequest $request)
    {

        $request['user_id'] = Auth::user()->id;
        UserProfile::updateOrCreate($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User successfully updated'
        ]);
    }

    public function userPurchase(UserPurchaseRequest $request)
    {
        $user = User::find(Auth::user()->id);

        $product = Product::find($request->product_id);

        

        $user->products()->attach($product, ['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully added product'
        ]);
    }
}
