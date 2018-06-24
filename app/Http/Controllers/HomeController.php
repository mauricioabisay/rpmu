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
        $client = new \Google_Client( [ 'client_id' => env('G_CLIENT_ID') ] );
        //Get user data from token
        $payload = $client->verifyIdToken($request->token);
        
        if ( $payload ) {
            //Token is valid, user data obtained 
            $user = User::where('email', $payload['email'])->first();
            if ( $user ) {
                Auth::login($user);
                return redirect('admin');
            } else {
                //User has not been registered
                $request->session()->flash('msg.type', 'warning');
                $request->session()->flash('msg.text', 'Lo sentimos tus datos de usuario no tienen permiso de acceso, comunícate con el administrador');
            }
        } else {
            //Token error
            $request->session()->flash('msg.type', 'warning');
            $request->session()->flash('msg.text', 'No se han podido validar tus credenciales de acceso, por favor intenta otra vez. Si el error persiste comunícate con el administrador');
        }
        return view('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('researches');
    }
}
