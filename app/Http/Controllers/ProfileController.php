<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
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
            'phone' => 'required_unless:type,off|unique:users'
        ]);

        if($data['type'] == 'sms')
        {
            if($request->user()->phone !== $data['phone'])
            {
                $code = ActiveCode::generateCode(auth()->user());
                $request->session()->flash('phone', $data['phone']);
                // TODO send sms

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

    public function getPhoneVerify(Request $request)
    {

        if(!$request->session()->has('phone'))
        {
            return redirect(route('profile.auth-factors'));
        }

        $request->session()->reflash();
        return view('profile.phone-verify');
    }

    public function sendPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(!$request->session()->has('phone'))
        {
            return redirect(route('profile.auth-factors'));
        }


        $status = ActiveCode::phoneVerify($request->token, $request->user());
        if($status)
        {
            $request->user()->ActiveCode()->delete();
            $request->user()->update([
                'auth_factor' => 'sms',
                'phone'       => $request->session()->get('phone')

            ]);

            alert()->success('Two-step authentication was successfully verified' , 'Authentication');
        }
        else
        {
            alert()->error('Two-step authentication was not successfully verified' , 'Authentication');
        }

        return redirect(route('profile.auth-factors'));

    }
}
