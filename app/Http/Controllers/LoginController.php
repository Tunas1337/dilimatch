<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Http\Controllers\UserController;

class LoginController extends Controller
{
    function index()
    {
    dd(Auth::User());
    }

    public function authenticate(Request $request)
    {
        /*return ($this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
           ]));*/

           $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
           );

           if(Auth::attempt($user_data))
           {
            #dd($user_data);
            if(!$request->session()->exists('uuid'))
                $request->session()->put('uuid', UserController::getOwnUUID($user_data['email']));
            return redirect("app");
           }
           else
           {
               return back()->with('error', 'Wrong Login Details');
               #dd('a');
               #return view('login',['error' => "Oops, we couldn't log you in. Please try again."]);
           }
        #dd($user_data);
    }
    public function logout(Request $request)
    {
     Auth::logout();
     $request->session()->flush();
     return redirect('main');
    }
}
