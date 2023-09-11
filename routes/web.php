<?php

use App\Http\Controllers\AskController;
use App\Http\Controllers\SalvadorController;
use App\Http\Controllers\StreamingChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/streaming-chat', StreamingChatController::class)->name('streaming-chat');

Route::get("/ask", AskController::class);

Route::get("/salvador", SalvadorController::class)->name("salvador");
Route::post("/salvador", SalvadorController::class)->name("salvador");

Route::get("/vue-test", function () {
    return view("vue-test");
});

Route::get('/', function () {
    return view('welcome');
});
