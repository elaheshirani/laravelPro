<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function twoFactorAuth()
    {
        return view('profile.two-factor-auth');
    }

    public function postTwoFactorAuth(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:off,sms',
            'phone' => 'required_unless:type,off'
        ]);

        return $data;
    }
}
