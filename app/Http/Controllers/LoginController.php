<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{


    public function login(/*Request $request*/)
    {

        if (Auth::attempt(['email' => 'test', 'password' => 'test'])) {

            dd('test');
            //return redirect()->to('user_dashboard');
        }
        dd('test2');

    }
}
