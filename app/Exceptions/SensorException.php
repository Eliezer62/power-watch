<?php

namespace App\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorException extends Exception
{
    public function __construct(string $msg, int $code) {
        parent::__construct($msg, $code);
    }

    public function render(Request $request): Response
    {
        return response()->json(
            [
                "msg" => parent::getMessage(),
                "timestamp" => Carbon::now(),
                'status' => parent::getCode(),
            ], parent::getCode());
    }
}
