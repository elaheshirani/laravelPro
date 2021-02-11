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

        if($data['type'] === 'off'){
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }

        if($data['type'] === 'sms'){
            if($request->user()->phone_number !== $data['phone']){
                return redirect(route('profile.twoFactor.phone'));
            } else {
                $request->user()->update([
                    'two_factor_type' => 'sms'
                ]);
            }
        }

        return $data;
    }

    public function getPhoneVerify()
    {
        return view('profile.phone-verify');
    }

    public function postPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        return $request->token;
    }
}
