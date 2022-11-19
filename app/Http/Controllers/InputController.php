<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hallo $name";
    }
    public function helloFirstName(Request $request): string
    {
        $firstname = $request->input('name.first');
        return "Hallo $firstname";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }
    public function helloArray(Request $request): string
    {
        $names = $request->input('products.*.name');
        return json_encode($names);
    }
}
