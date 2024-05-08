<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-and-insert', [ApiController::class, 'fetchAndInsert']);
