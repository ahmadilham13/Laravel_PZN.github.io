<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect To";
    }
    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', [
            "name" => "ilham",
            "asal" => "jambi"
        ]);
    }
    public function redirectHello(string $name, string $asal): string
    {
        return "Hello $name yang dari $asal";
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Ilham', 'asal' => 'Jambi']);
    }
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.ahmadilham13.com/');
    }
}
