<?php

use App\Http\Controllers\AllController;
use Illuminate\Support\Facades\Route;

// PAGE
Route::get('/', [AllController::class, 'index']);
Route::get('/anime/detail', [AllController::class, 'animeDetail']);
Route::get('/blog', [AllController::class, 'blog']);
Route::get('/blog/detail', [AllController::class, 'blogDetail']);
Route::get('/categories', [AllController::class, 'categories']);
Route::get('/main', [AllController::class, 'main']);
Route::get('/watching', [AllController::class, 'watching']);
// AUTH PAGE
Route::middleware('guest')->group(function () {
    Route::get('/login', [AllController::class, 'login'])->name('login');
    Route::get('/signup', [AllController::class, 'signup'])->name('signup');
    Route::post('/login', [AllController::class, 'loginProcess'])->name('login.process');
    Route::post('/signup/process', [AllController::class, 'signupProcess'])->name('signup.process');
});
// ANIME
Route::get('/', [AllController::class, 'animeList'])->name('anime.list');
Route::get('/anime-detail/{id}', [AllController::class, 'animeDetail'])->name('anime.detail');
Route::middleware('auth')->group(function () {
    Route::get('/anime/{id}/watching', [AllController::class, 'watching'])->name('anime.watching');
    Route::post('/logout', [AllController::class, 'logout'])->name('logout');
    Route::get('/profile', [AllController::class, 'profile'])->name('profile');
});
Route::get('/api/episode-source', [AllController::class, 'getEpisodeSource']);
Route::get('/genre/{genre}', [AllController::class, 'genreAnime'])->name('anime.genre');
Route::get('/search', [AllController::class, 'search'])->name('anime.search');
Route::post('/anime/follow', [AllController::class, 'toggleFollow'])->name('anime.follow')->middleware('auth');
Route::post('/anime/comment', [AllController::class, 'storeComment'])->name('anime.comment')->middleware('auth');