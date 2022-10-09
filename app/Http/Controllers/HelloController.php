<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello($name)
    {
        return $this->helloService->hello($name);
    }

    public function request(Request $request)
    {
        return $request->url() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header('Accept');
    }
}
