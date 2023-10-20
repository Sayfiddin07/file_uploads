<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            return dd($e);
        });
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                switch (true) {
                    case $e instanceof NotFoundHttpException:
                        return response()->json([
                            'status' => false,
                            'code' => 404,
                            'message' => 'Not Found!',
                            'data' => []
                        ]);
                    case $e instanceof MethodNotAllowedHttpException:
                        return response()->json([
                            'status' => false,
                            'code' => 405,
                            'message' => 'Method not allowed!',
                            'data' => []
                        ]);
                    case $e instanceof BadRequestHttpException:
                        return response()->json([
                            'status' => false,
                            'code' => 400,
                            'message' => 'Bad Request!',
                            'data' => []
                        ]);

                    default:
                        return response()->json([
                            'status' => false,
                            'code' => 500,
                            'message' => 'Internal server error',
                            'data' => []
                        ]);
                }
            }
        });

    }
}
