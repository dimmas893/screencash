<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Screencast\PlaylistResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyplaylistController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $playlists = Auth::user()->purchases()->latest()->paginate(10);
        return PlaylistResource::collection($playlists);
    }
}
