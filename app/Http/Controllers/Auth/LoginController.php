<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Asegúrate de usar Illuminate\Http\Request

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'RP';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'RP' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
