<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'show']);
Route::get('/post/{id}', [BlogController::class, 'showPost']);
Route::get('/topic/{slug}', [BlogController::class, 'showTopicPosts']);
Route::get('/author/{id}', [BlogController::class, 'showAuthorPosts']);
