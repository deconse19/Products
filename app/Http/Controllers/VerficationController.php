<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerficationController extends Controller
{
    public function verify($id)
    {

        $user = User::findOrFail($id);
       
        $user->update(['email_verified_at' => now()]);

        return view('success');
    }
}
