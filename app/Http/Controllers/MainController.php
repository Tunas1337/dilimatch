<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class MainController extends Controller
{
    function main(Request $request)
    {
        #dd($request->session()->get('uuid'));
        if (null !== $request->session()->get("uuid"))  return view('main');
        else return redirect()->intended("login");
        return view('main');
    }
    function profile(Request $request)
    {
        $me = UserController::getUser($request, $request->session()->get('uuid'), true);
        #dd($me);
        if (null !== $request->session()->get('uuid'))  return view('profile', [
            'name' => $me['name'],
            'bio' => $me['bio'],
            'interests' => $me['interests'],
            'preference' => $me['preference']
        ]);
        else return redirect()->intended("/login");
    }
    function update_profile(Request $request)
    {
        if (null !== $request->session()->get('uuid')) {
            UserController::updateUser($request, $request->session()->get('uuid'));
            return redirect(route("profile",[
                'changed' => true
            ]));
        } else return redirect()->intended("/login");
    }
}
