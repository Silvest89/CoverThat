<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Google_Client;
use Google_Service_Drive;

class LoginController extends Controller
{
    public function index() {

        /*$client = new Google_Client();
        $client->setAuthConfig(base_path('client_secrets.json'));
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');

        $auth_url = $client->createAuthUrl();
        dd($auth_url);*/
        return view('dashboard.login');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route('dashboard_home'));
        }

        \Session::flash('flash_error', 'Email and/or password is incorrect.');

        return redirect()->back();
    }
}
