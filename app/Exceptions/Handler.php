<?php

namespace App\Exceptions;

use Exception;

class Handler extends Exception
{
    public function render($request, Throwable $exception) {
    if ($exception instanceof AuthorizationException) {
        return response()->view('errors.403', [], 403);
    }
    return parent::render($request, $exception);
    }
}
