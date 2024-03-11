<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserPurchaseRequest;
use App\Mail\VerificationMail;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * @group User management
 *
 * APIs for managing users
 */

class UserController extends Controller

{
     /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {

            $user = User::create($request->validated());

            Mail::to($request->email)->send(new VerificationMail($user));

            DB::commit();
            return response()->json([
                'message' => 'User register successfully.',
                'status'    => $user
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([

                'message' => $e->getMessage()

            ], 422);
        }
    }

    /**
     * Create a new user profile
     *
     * @param CreateUserProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProfile(CreateUserProfileRequest $request)
    {

        $request['user_id'] = Auth::user()->id;
        UserProfile::updateOrCreate($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User successfully updated'
        ]);
    }
    /**
     * Attach a product to the user's cart if the user is currently logged in.
     *
     * @param UserPurchaseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

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
