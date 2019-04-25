<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class TeacherLoginController extends Controller
{
	//middleware for teachers who are not logged in
	public function __construct(){
		$this->middleware('guest:teacher');
	}

    public function showLoginForm(){
    	return view('auth.teacher-login');
    }

    public function login(Request $request){

        //\Log::info('This is some useful information.'); //for debugging

    	//validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //\Log::info('About to attempt to log the user in.');//for debugging
    	//attempt to log the user in - returns true if successful, false if unsuccessful
    	if(Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
    		//if successful, then redirect to their intended location (default intended location being the teacher dashboard)
            //\Log::info('Successful login! Yay!');  //for debugging

            //response after teacher successfully authenticated 
            $request->session()->regenerate();   

            return view('teacher_dashboard');
    	}
        \Log::info('Unsuccessful login.');//for debugging
    	//if unsuccessful, then redirect back to the login with the form data
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    //Logs out teacher
    public function teacherLogout(){
        Auth::guard('teacher')->logout();
        $request->session()->invalidate(); 
        return redirect('/');
    }

}
