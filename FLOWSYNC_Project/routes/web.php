<?php

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
//CODING ASAL
/*Route::get('/', function () {
    return view('welcome');
});*/


Route::view('/','welcome');
Route::view('/CLIENTS','clients');
Route::view('/ABOUT','about');
Route::view('/CONTACT','contact');

//use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login'); // Renders the login page
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $username = $request->input('user');
    $password = $request->input('pass');

    if ($username === 'admin' && $password === 'admin') {
        return redirect('/')->with('message', 'Login Successful');
    } else {
        return back()->with('error', 'Invalid Credentials');
    }
});


