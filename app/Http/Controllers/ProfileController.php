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
        $data = $request->validate([
            'type' => 'required|in:sms,off',
            'phone' => 'required_unless:type,off'
        ]);

        if($data['type'] == 'sms')
        {
            if($request->user()->phone !== $data['phone'])
            {
                return redirect(route('profile.auth-factors.phone'));

            } else {
                $request->user()->update([
                    'auth_factor' => 'sms'
                ]);
            }
        }

        if($data['type'] == 'off')
        {
            $request->user()->update([
                'auth_factor' => 'off'
            ]);
        }

        return back();
    }

    public function getPhoneVerify()
    {
        return view('profile.phone-verify');
    }

    public function sendPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        return $request->token;
    }
}
