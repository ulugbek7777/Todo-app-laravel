<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 

Route::get('/user-create', function () {
    App\User::create([
        'name' => 'ulug on code',
        'email' => 'dchvbjdfhvbj@gmail.com',
        'password' => Hash::make('mysuperduperpassword')
    ]);
});

Route::post('/login', function () {
    $credentials = [
        'email' => 'dchvbjdfhvbj@gmail.com',
        'password' => 'mysuperduperpassword'
    ];
    // $credentials = request()->only(['email', 'password']);
    $token = auth()->attempt($credentials);

    return response()->json($token);
});

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return auth()->user();
});