<?php

namespace App\Http\Controllers\Dashboard;
use App\Facades\OAuth\JHFacebook;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Facades\OAuth\JHGoogle;

class LoginController extends Controller
{

    public function index() {

        return view('dashboard.login');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route('dashboard_home'));
        }

        return redirect()->back()->withErrors(['flash_error' => 'Email and/or password is incorrect.']);
    }

    public function googleSingleSignOn()
    {

        $youtube = new JHGoogle(JHGoogle::SCOPE_SSO);
        return redirect($youtube->createAuthUrl());
    }

    public function facebookSingleSignOn()
    {

        $fb = new JHFacebook(JHFacebook::SCOPE_SSO);
        return redirect($fb->createAuthUrl());
    }
}
