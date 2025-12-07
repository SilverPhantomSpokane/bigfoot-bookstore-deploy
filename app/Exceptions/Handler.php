<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // 1. Authentication:token invalid or missing
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 'Unauthenticated.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // 2. Authorization: role/user cannot perform this action
        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'error' => 'This action is unauthorized.'
            ], Response::HTTP_FORBIDDEN);
        }

        // 3. Model not found (id)
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        // 4. if none of the above, use the default error handling
        return parent::render($request, $exception);
    }
}

