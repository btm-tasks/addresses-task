<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class CustomExceptionHandler extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        //send error to email or to slack, in a queue job of-course to not take any process time
        //let's log it, that's enough, it's not a real live project
        Log::error($message);
    }
}
