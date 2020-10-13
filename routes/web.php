<?php

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
    return view('welcome');
});

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    $exec = \App\WorkflowExec::where('id', 1)->first();

    \Mail::to('j.ngomnze@gabontelecom.ga')->send(new \App\Mail\WorkflowActionNext($exec));

    dd("Email is Sent.");

});
