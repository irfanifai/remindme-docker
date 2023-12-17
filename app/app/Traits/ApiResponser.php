<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

trait ApiResponser
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json([
            'oke' => 'true',
            'data' => $data
        ], $code);
    }

    protected function errorResponse($data, $code = 406)
    {
        return response()->json([
            'oke' => 'false',
            'data' => $data
        ], $code);
    }
}
