<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

//**needed for the unauthenticated method
use Illuminate\Auth\AuthenticationException;   

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
        return parent::render($request, $exception);
    }

    //**to override the handler function in the vendor directory
    //Redirects users who are not logged in to the login page (redirects to parent login if guest tries to
    //access parent-specific pages anf redirects to teacher login if guest tries to access teacher-specific
    //pages)
    protected function unauthenticated($request, AuthenticationException $exception){

        $guard = array_get($exception->guards(), 0);

        switch ($guard){
            case 'teacher':
                #if using the teacher guard, go to the teacher login
                $login = 'teacher.login';
                break;

            default:
                #web guard response (for users, aka parents) - the default response
                $login = 'login';
                break;
        }

        //return redirect()->guest(route('login')); //original return statement before modification of this method
        return redirect()->guest(route($login));

    }


}
