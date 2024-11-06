<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/anime/{slug}', [AnimeController::class, 'show']);