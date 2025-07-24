<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhieuYeuCauController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('phieu-yeu-cau', PhieuYeuCauController::class);
});
