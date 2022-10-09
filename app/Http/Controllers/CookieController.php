<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie()
    {
        return response('Hello Cookie')
            ->cookie('User-Id', 'john', 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/');
    }

    public function getCookie(Request $request)
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', 'guest'),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    public function clearCookie()
    {
        return response('Clear Cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }
}
