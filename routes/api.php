<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallbackController;

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'midtransCallback'])
    ->name('midtrans.callback');

Route::get('/test', function () {
    return response()->json(['message' => 'test']);
});