<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\genreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RechercheController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//book
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/book', [BookController::class, 'store']);
    Route::get('/books', [BookController::class, 'show_all']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/book/update/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});

//member
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/member', [MemberController::class, 'store']);
    Route::get('/members', [MemberController::class, 'show_all']);
    Route::get('/member/{id}', [MemberController::class, 'show']);
    Route::post('/member/update/{id}', [MemberController::class, 'update']);
    Route::delete('/member/{id}', [MemberController::class, 'destroy']);
});

//genre
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/genre', [genreController::class, 'store']);
    Route::get('/genres', [genreController::class, 'show_all']);
    Route::get('/genre/{id}', [genreController::class, 'show']);
    Route::post('/genre/update/{id}', [genreController::class, 'update']);
    Route::delete('/genre/{id}', [genreController::class, 'destroy']);
});

//reservation
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/reservi', [ReservationController::class, 'store']);
    Route::get('/reservation', [ReservationController::class, 'show_all']);
    Route::get('/reservation/{id}', [ReservationController::class, 'show']);
    Route::post('/reserv/update/{id}', [ReservationController::class, 'update']);
    Route::delete('/reserv/{id}', [ReservationController::class, 'destroy']);
});

//Loan
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/Loan', [LoanController::class, 'store']);
    Route::get('/Loans', [LoanController::class, 'show_all']);
    Route::get('/Loan/{id}', [LoanController::class, 'show']);
    Route::post('/Loan/update/{id}', [LoanController::class, 'update']);
    Route::delete('/Loan/{id}', [LoanController::class, 'destroy']);
});

//recherche
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/recherche', [RechercheController::class, 'recherche']);
});