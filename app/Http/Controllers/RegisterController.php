<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{


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
            ],201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                
                'message' => $e->getMessage()

            ], 422);
        }
    }


   

}
