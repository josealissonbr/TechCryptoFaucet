<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        //Check if user is already logged in
        if (Auth::check())
            return redirect('/');

        return view('auth.login');
    }

    
}
