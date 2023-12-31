<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * @OA\Schema(
     *     schema="UnauthenticatedException",
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         description="Error message",
     *         example="Unauthenticated."
     *     ),
     *     @OA\Property(
     *       property="error_code",
     *       type="integer",
     *       description="Error code",
     *       example=401001
     *     )
     * )
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        Log::error('Unauthenticated');
        Log::error($exception->getMessage());
        return $this->shouldReturnJson($request, $exception)
                    ? response()->json([
                        'message' => $exception->getMessage(),
                        'error_code' => 401001,
                    ], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
        
    }
}
