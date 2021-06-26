<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function authFactors()
    {
        return view('profile.auth-factors');
    }

    public function updateAuthFactors(Request $request)
    {
        $request->validate([
            'type' => 'required|in:sms,off',
            'phone' => 'required_unless:type,off'
        ]);
        return $request->all();
    }
}
