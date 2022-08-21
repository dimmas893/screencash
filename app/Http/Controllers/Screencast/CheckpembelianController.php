<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Screencast\Playlist;
use App\Models\User;

class CheckpembelianController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Playlist $playlist)
    {
       return response()->json([
            'data' => $request->user()->hasBought($playlist),
       ]);
    }
}
