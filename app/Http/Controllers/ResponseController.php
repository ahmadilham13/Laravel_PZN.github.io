<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('Hello Response');
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Ahmad',
            'lastName' => 'Ilham'
        ];

        return response(json_encode($body), 200)
                ->header('Content-Type', 'application/json')
                ->withHeaders([
                    'Author' => 'Programmer',
                    'App' => 'Belajar Laravel'
                ]);
    }
    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', [
                'name' => 'Ilham'
            ]);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            "firstName" => 'Ahmad',
            "lastName" => 'Ilham'
        ];
        return response()
            ->json($body);
    }
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
                ->file(storage_path('app/public/pictures/ilham.png'));
    }
    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
                ->download(storage_path('app/public/pictures/ilham.png'));
    }
}
