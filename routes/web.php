<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/test', function () {
    $name = request('name');
    return view('test', [
        'name' => $name
    ]);
});
Route::get('listusers', function () {
    return view('listusers');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('users/{id}', 'App\Http\Controllers\UserController@getUser');

    Route::post('users/{id}', 'App\Http\Controllers\UserController@handleChoice');

    Route::get('/app', 'App\Http\Controllers\MainController@main')->name('app');
    Route::get('/app', 'App\Http\Controllers\MainController@main')->name('home');
    #Route::middleware(['auth:sanctum','verified'])->get('/app', 'App\Http\Controllers\MainController@main')->name('app');

    #Route::get('/', 'App\Http\Controllers\MainController@main');

    Route::get('logout', 'App\Http\Controllers\LoginController@logout');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/app/profile', 'App\Http\Controllers\MainController@profile')->name('profile');
Route::post('/app/profile/update', 'App\Http\Controllers\MainController@update_profile');
Route::get('/app/matches', 'App\Http\Controllers\MatchController@populateMatches');

Route::post('/auth', 'App\Http\Controllers\LoginController@authenticate');
Route::get('/register', 'App\Http\Controllers\RegistrationController@create');
Route::post('/register', 'App\Http\Controllers\RegistrationController@store')->name('register');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/app');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/main', function () {
    return redirect('login');
});

Route::get('/', function() {
    return redirect('app');
});

Route::get('/tostsokashkaval', 'App\Http\Controllers\vendor\Chatify\MessagesController@addMatch');
