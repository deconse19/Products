<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerficationController extends Controller
{
    /**
     * Verify the user with the given ID.
     *
     * @param int $id The ID of the user to verify.
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {

        $user = User::findOrFail($id);

        $user->update(['email_verified_at' => now()]);

        return view('success');
    }
}
