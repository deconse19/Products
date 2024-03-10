<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->email_verified_at === null) {

                return response()->json([

                    'error' => 'Please verify your email address',
                    'status' => 401
                ]);
            }
            $success['name'] = $user->name;
            $success['token'] = $user->createToken('Token')->accessToken;


            return response()->json($success, 200);
        } else {

            return response()->json([

                'error' => 'Unauthorised',
                'status' => 401
            ]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
