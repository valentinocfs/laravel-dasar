<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo()
    {
        return 'Redirect to';
    }

    public function redirectFrom()
    {
        return redirect('/redirect/to');
    }

    public function redirectHello($name)
    {
        return "Hello $name";
    }

    public function redirectName()
    {
        return redirect()->route('redirect-hello', [
            'name' => 'John'
        ]);
    }

    public function redirectAction()
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'John']);
    }

    public function redirectAway()
    {
        return redirect()->away('https://twitter.com/elonmusk');
    }
}
