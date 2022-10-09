<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(): Response
    {
        return response('Hello Response');
    }

    public function header(): Response
    {
        $body = [
            'firstname' => 'John',
            'lastname' => 'Doe'
        ];

        // return response(json_encode($body), 200, ['App' => 'Laravel Dasar']);

        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'John Freddy Doe',
                'App' => 'Laravel Dasar'
            ]);
    }

    public function responseView(): Response
    {
        return response()->view('hello', ['name' => 'John Doe']);
    }

    public function responseJson(): JsonResponse
    {
        $body = [
            'firstname' => 'John',
            'lastname' => 'Doe'
        ];
        return response()->json($body);
    }

    public function responseFile(): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/default.png'));
    }

    public function responseDownload(): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/default.png', 'default.png'));
    }
}
