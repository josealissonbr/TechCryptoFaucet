<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    public function index(){
        //Check if user is already logged in
        if (Auth::check())
            return redirect('/');

        return view('auth.login');
    }

    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        $credentials = $request->except(['_token']);
    
        $user = User::where('email',$request->email)->first();
    
        if (auth()->attempt($credentials)) {
    
            return response()->json(
                [
                    'status'    =>  'success',
                    'message'   =>  'Login success!',
                    'redirector' => route('login.redirector'),
                ]
            );
    
        }else{
            return response()->json(
                [
                    'status'    =>  'error',
                    'message'   =>  'invalid email or password'
                ]
            );
            //session()->flash('message', 'Invalid credentials');
            //return redirect()->back();
        }
    }

    
}
