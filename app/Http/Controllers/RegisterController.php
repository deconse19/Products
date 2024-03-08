<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SignupUserRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{


    public function signUp(SignupUserRequest $request)
    {
        DB::beginTransaction();
        try {
         
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Mail::to($request->email)->send(new VerificationMail($user));
            
            DB::commit();
            return response()->json([
                'message' => 'User register successfully.',
                'status'    => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                
                'message' => $e->getMessage()

            ], 422);
        }
    }


   

}
