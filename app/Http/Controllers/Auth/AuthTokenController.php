<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }

        return view('auth.token');
    }

    public function sendToken(Request $request)
    {
        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }
    }
}
