<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Screencast\PlaylistController;
use App\Http\Controllers\Screencast\TagController;
use App\Http\Controllers\Screencast\VideoController; 
use App\Http\Controllers\Screencast\MyplaylistController; 
use App\Http\Controllers\Screencast\CheckpembelianController; 
use App\Http\Controllers\Order\CartController;
use App\Http\Controllers\Order\OrderController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', MeController::class);
    Route::get('playlists/mine', MyplaylistController::class);

    // order
    Route::get('carts', [CartController::class, 'index']);
    Route::post('add-to-cart/{playlist:slug}', [CartController::class, 'store']);
    Route::delete('remove-cart/{cart}', [CartController::class, 'destroy']);


    Route::get('check-if-user-has-bought-the-series-{playlist:slug}', CheckpembelianController::class);
    Route::post('orders/create', [OrderController::class, 'store']);
});

Route::prefix('playlists')->group(function () {
    Route::get('', [PlaylistController::class, 'index']);
    Route::get('{playlist:slug}', [PlaylistController::class, 'show']);

    // video
    Route::get('{playlist:slug}/videos', [VideoController::class, 'index']);
    Route::get('{playlist:slug}/{video:episode}', [VideoController::class, 'show'])->middleware('auth:sanctum');
});

Route::post('info', [OrderController::class, 'notificationHandler']);




?>