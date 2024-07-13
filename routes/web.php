<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/top-authors', [AuthorController::class, 'index'])->name('top-authors');
Route::get('/rate-book', [BookController::class, 'rate'])->name('books.rate');
Route::post('/rate-book', [BookController::class, 'storeRating'])->name('books.storeRating');

