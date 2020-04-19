<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $remember = ($request->has('remember')) ? true : false;
        $auth = auth()->attempt($request->only('username', 'password'), $remember);

        if ($auth)
        {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('credentials', 'Invalid Credentials Input.');
        }
    }
    
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
