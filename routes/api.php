<?php

use App\Http\Controllers\ParteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('partes', ParteController::class);
