<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\CustomException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {     
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json("Invalid endpoint.", 404);
        });

    }

    public function render($request, Throwable $e)
    {
      if ($e instanceof TokenExpiredException) {
        return response()->json(['error' => $e->getMessage()], 401);
        //return response()->json(['token_expired'], $e->getCode());
      } elseif ($e instanceof TokenInvalidException) {
       return response()->json(['message' => 'token_invalid'], 401);
        //return response()->json(['error' => $e->getMessage()], $e->getCode());
      } elseif ($e instanceof JWTException) {
       return response()->json(['message' =>'token_absent'], 401);
      //  return response()->json(['error' => $e->getMessage()], $e->getCode());
      } elseif ($e instanceof Illuminate\Auth\AuthenticationException) {
        return response()->json(['message' =>'unauthenticated'], 401);
      }  
      // else {
      //   return response()->json(['message' =>$e], 401);
      // }
      
      // elseif ($e instanceof ModelNotFoundException) {
      //   return response()->json(['message' =>'wrong endpoint?'], 404);
      // } elseif ($e instanceof NotFoundHttpException) {
      //   return response()->json(['message' => 'Invalid endpoint.'], 404);
      // }
      
      return parent::render($request, $e);
    }
/*
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
          return response()->json(['message' => 'token_invalid'], 401);
        }
    }
    */
    

}
