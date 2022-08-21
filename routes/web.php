<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\Screencast\PlaylistController;
use App\Http\Controllers\Screencast\TagController;
use App\Http\Controllers\Screencast\VideoController;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DasboardController::class)->name('dashboard');

    // playlis
    Route::prefix('playlists')->middleware('permission:create playlist')->group(function () {
        Route::get('create', [PlaylistController::class, 'create'])->name('playlists.create');  
        Route::post('create', [PlaylistController::class, 'store']);
        Route::get('{playlist:slug}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');  
        Route::put('{playlist:slug}/edit', [PlaylistController::class, 'update']); 
        Route::delete('{playlist:slug}/delete', [PlaylistController::class, 'destroy'])->name('playlists.delete');
        Route::get('table', [PlaylistController::class, 'table'])->name('playlists.table');  
    });

    // videos
    Route::prefix('videos')->middleware('permission:create playlist')->group(function () {
        Route::get('create/into/{playlist:slug}', [VideoController::class, 'create'])->name('videos.create');
        Route::post('create/into/{playlist:slug}', [VideoController::class, 'store']);
        Route::get('edit/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'edit'])->name('videos.edit');  
        Route::put('edit/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'update']); 
        Route::delete('delete/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'destroy'])->name('videos.delete');  ; 
        Route::get('table/{playlist:slug}', [VideoController::class, 'table'])->name('videos.table');  
    });

    // tag
    Route::prefix('tags')->middleware('permission:create tags')->group(function () {
        Route::get('create', [TagController::class, 'create'])->name('tags.create'); 
        Route::post('create', [TagController::class, 'store']);
        Route::delete('{tag:slug}/delete', [TagController::class, 'destroy'])->name('tags.delete');
        Route::get('table', [TagController::class, 'table'])->name('tags.table');  
        Route::get('{tag:slug}/edit', [TagController::class, 'edit'])->name('tags.edit');  
        Route::put('{tag:slug}/edit', [TagController::class, 'update']); 
        Route::delete('{tag:slug}/delete', [TagController::class, 'destroy'])->name('tags.delete');
    });
});

require __DIR__.'/auth.php';
