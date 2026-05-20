<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// images classify
Route::middleware(['auth:sanctum', App\Http\Middleware\ValidateEditorRole::class, App\Http\Middleware\ManagePublicOffer::class])->post('/public-offer/{offer}/images/classify/{image}', App\Http\Controllers\Dashboard\ImagesClassify::class)
->name('dashboard.classify-image');
