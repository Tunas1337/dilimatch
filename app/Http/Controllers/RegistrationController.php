<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Laravel\Fortify\Fortify;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    static function make_uuid()
    {
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
    }
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|regex:/(.*)student\.uwcdilijan\.am$/i',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'bio' => 'required',
            'interests' => 'required',
            'preference' => 'required',
        ]);
        $user = new User;
        $user->email = request('email');
        $user->info = request('info');
        $user->uuid = RegistrationController::make_uuid();
        $user->password = bcrypt(request('password'));
        $user->gender = request('gender');
        $user->gender = request('gender');
        $user->preferred_gender = request('preferred_gender');
        $user->info = '[{"bio":"' . request('bio') . '","name":"' . request('name') . '","interests":"' . request('interests') . '","preference":"' . request('preference') . '"}]';
        $user->save();
        event(new Registered($user));

        #Fortify::CreateNewUser();
        #$user = User::create(request(['name', 'email', 'password']));

        Auth::login($user);
        if (!$request->session()->exists('uuid'))
            $request->session()->put('uuid', $user->uuid);
        return redirect("app");
    }
}
