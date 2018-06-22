<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( $user = Auth::user() ) {
            return view('dashboard');
        } else {
            return view('login');
        }
    }

    public function login(Request $request) 
    {
        $user = User::where('email', $request->email)->first();
        //Update user password, if user is new has no password
        if ( $user ) {
            if ( $user->password === '' ) {
                $user->password = $request->password;
                $user->save();
            }
            if ( $user->password === $request->password ) {
                Auth::login($user);
                return redirect('admin');
            }
        }

        return view('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('researches');
    }
}
