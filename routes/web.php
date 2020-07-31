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

Route::get('/', function () {
    return view('welcome',['messages'=>\App\Http\Controllers\ChatController::showAll()]);
})->name('index');

Route::post( 'sendMessage',function (){

    $message=$_POST['messageText'];
    \App\Http\Controllers\ChatController::sendMessage($message);
    return redirect()->route('index');

});
Route::get( 'sendMessage',function (){
    return redirect()->route('/');

});


