<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

      if ($exception instanceof MethodNotAllowedHttpException) {
        $res['error'] = "Salah Pakai Method";
        $res['message'] = $exception->getMessage();
        return response($res,405);
      }
      if ($exception instanceof NotFoundHttpException) {
        $res['error'] = "Base URL yang Kamu Masukan Salah , Tidak Ada Base Url Yang Terkait";
        return response($res,404);
      }

      if (config('app.debug')) {
       return parent::render($request, $exception);
      }

      return $this->errorResponse('Unexpected Exception. Try later', 500);

    }
}
