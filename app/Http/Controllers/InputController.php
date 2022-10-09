<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request)
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function helloFirst(Request $request)
    {
        $firstname = $request->input('name.first');
        return "Hello $firstname";
    }

    public function helloInpu(Request $request)
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function helloArray(Request $request)
    {
        $input = $request->input('products.*.name');
        return json_encode($input);
    }

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('false');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            "name" => $name,
            "married" => $married,
            "birth_date" => $birthDate->format('Y-m-d')
        ]);
    }

    public function filterOnly(Request $request)
    {
        $name = $request->only(['name.first', 'name.last']);

        return json_encode($name);
    }

    public function filterExcept(Request $request)
    {
        $user = $request->except(['admin']);

        return json_encode($user);
    }

    public function mergeInput(Request $request)
    {
        $request->merge(['admin'=>'false']);
        $user = $request->input();

        return json_encode($user);
    }
}
