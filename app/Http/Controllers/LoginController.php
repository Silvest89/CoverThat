<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{


    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->to('user_dashboard');
        }

    }
}
