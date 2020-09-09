<?php

namespace App\Exceptions;

use App\Common\Exceptions\ApplicationException;
use App\Common\Exceptions\ListEmptyException;
use App\Common\Exceptions\NotFoundException;
use App\Common\StandardApiResultStatusCode;
use App\WebFramework\Api\ApiResult;
use App\WebFramework\Api\ApiResultWithData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ValidationException){
     
            $errors = collect($exception->validator->errors()->all())->map(function($error){
                return $error;
            });
            
            return response()->json(new ApiResultWithData($errors,false,StandardApiResultStatusCode::BadRequest));
            
        }else if($exception instanceof ListEmptyException){

            return response()->json(new ApiResult(false,StandardApiResultStatusCode::ListEmpty));

        }else if($exception instanceof NotFoundException || $exception instanceof ModelNotFoundException){

            return response()->json(new ApiResult(false,StandardApiResultStatusCode::NotFound));

        }else if($exception instanceof ApplicationException){

            return response()->json(new ApiResult(false,StandardApiResultStatusCode::ServerError));

        }else if($exception instanceof BadRequestException){

            return response()->json(new ApiResult(false,StandardApiResultStatusCode::BadRequest,$exception->getMessage()));

        }
        dd($exception);
    }
}
