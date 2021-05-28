<?php

namespace Areaseb\Estate\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

//login - GET
    public function login()
    {
        return view('estate::login');
    }

//login - POST
    public function loginPost(Request $request)
    {

        $this->validate(request(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if( \Auth::attempt($request->except('_token')) )
        {
            return redirect('/');
        }
        return back()->with('error', 'Email o password non corrette');
    }

//logout - POST
    public function logout()
    {
        \Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect(route('login'));
    }


}
