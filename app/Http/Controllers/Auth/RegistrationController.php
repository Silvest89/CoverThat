<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegistrationRequest;
use App\Models\Account\Account;
use App\Models\Account\AccountInformation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;

class RegistrationController extends Controller
{

    public function index() {

        return view('register');
    }

    public function register(RegistrationRequest $request) {

        try {

            $account = new Account;

            $account->email = $request->email;
            $account->password = Hash::make($request->password);
            $account->save();

            $information = new AccountInformation;

            $information->account_id = $account->id;
            $information->first_name = $request->first_name;
            $information->last_name = $request->last_name;
            $information->save();

            if(Auth::loginUsingId($account->id))
                dd('Account succesfully created');

        }
        catch(Exception $e) {
            dd($e->getMessage());
        }
    }
}
