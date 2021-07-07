<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }

        $request->session()->reflash();

        return view('auth.token');
    }

    public function sendToken(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }

        $user = User::findOrFail($request->session()->get('auth.user_id'));

        $status = ActiveCode::phoneVerify($request->token , $user);
        if(! $status)
        {
            alert()->error('Your code is incorrect');
            return redirect(route('login'));
        }

        if(auth()->loginUsingId($user->id, $request->session()->get('auth.remember')))
        {
            $user->activeCode()->delete();
            return redirect('/');
        }

        return redirect(route('login'));
    }
}
