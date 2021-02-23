<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');

Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');

Route::get('/playlists/{id}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');

Route::post('/playlists/{id}', [PlaylistController::class, 'update'])->name('playlist.update');

Route::get('/tracks', [TrackController::class, 'index'])->name('track.index');

Route::get('/tracks/new', [TrackController::class, 'create'])->name('track.create');

Route::post('/tracks', [TrackController::class, 'store'])->name('track.store');

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}