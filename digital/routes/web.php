<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contact;
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
    return view('en');
});

Route::post('/Insertq', [Contact::class, 'Insertq'])->name('Insertq');

Route::get('ar', function () {
    return view('ar');
});
