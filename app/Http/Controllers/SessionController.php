<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put('username', 'ilham13');
        $request->session()->put('is-Member', true);
        return "Ok";
    }
    public function getSession(Request $request): string
    {
        $username = $request->session()->get('username', 'guest');
        $isMember = $request->session()->get('is-Member', 'false');
        
        return "Username : ${username}, Is Member : ${isMember}";
    }
}
