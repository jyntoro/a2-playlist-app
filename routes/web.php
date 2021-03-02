<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AlbumController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Genre;
use App\Models\Album;

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

Route::get('/albums', [AlbumController::class, 'index'])->name('album.index');

Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create');

Route::post('/albums', [AlbumController::class, 'store'])->name('album.store');

Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('album.edit');

Route::post('/albums/{id}', [AlbumController::class, 'update'])->name('album.update');

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}