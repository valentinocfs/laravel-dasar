<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function form()
    {
        return response()->view('form');
    }

    public function submitForm(Request $request)
    {
        $name = $request->input('name');
        return response()->view('hello', ['name' => $name]);
    }
}
