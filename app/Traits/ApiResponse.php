<?php

namespace App\Traits;

use Illuminate\Http\Response;
trait ApiResponse
{
    public function successResponse($data, $code = Response::HTTP_OK, $msj = '')
    {
        return response()->json(array("data" => $data, "status" => $code, "msj" => $msj), $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function errorResponse($data, $code = Response::HTTP_BAD_REQUEST, $msj = '')
    {
        return response()->json(array("data" => $data, "status" => $code, "msj" => $msj), $code);
    }
}
