<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
    //

    public function index() {

        return view('dashboard.home');
    }


    public function logout() {

        Auth::logout();

        return redirect()->to('dashboard/logout');

    }
}
