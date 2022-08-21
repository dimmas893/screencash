<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Screencast\Playlist;
use App\Models\Screencast\Video;
use App\Http\Resources\Screencast\VideoResource;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function create(Playlist $playlist)
    {
        $this->authorize('policy', $playlist);
        return view('videos.create', [
            'playlist' => $playlist,
            'title' => "New video: {$playlist->name}",
            'video' => new Video()
        ]);
    }

    public function store(Playlist $playlist, Request $request)
    {
        $this->authorize('policy', $playlist);
        $attribut = request()->validate([
            'title' => 'required',
            'episode' => 'required',
            'runtime' => 'required',
            'unique_video_id' => 'required',
        ]);

        $attribut['slug'] = Str::slug($request->title . '-' . Str::random(6));
        $attribut['intro'] = $request->intro ? true : false;
        $playlist->videos()->create($attribut);

        return back();
    }

    public function table(Playlist $playlist)
    {
        $this->authorize('policy', $playlist);
        return view('videos.table', [
            'title' => "Table of {$playlist->name} content",
            'playlist' => $playlist,
            'videos' => $playlist->videos()->orderBy('episode')->paginate(20),
        ]);
    }
    
    public function edit(Playlist $playlist, Video $video)
    {
        $this->authorize('policy', $playlist);
        return view('videos.edit', [
            'playlist' => $playlist,
            'video' => $video,
            'title' => "edit video: {$playlist->name} - {$video->title}",
        ]);
    }

    public function update(Playlist $playlist, Video $video, Request $request)
    {
        $this->authorize('policy', $playlist);
        $attribut = request()->validate([
            'title' => 'required',
            'episode' => 'required',
            'runtime' => 'required',
            'unique_video_id' => 'required',
        ]);

        $attribut['intro'] = $request->intro ? true : false;
        $video->update($attribut);

        return redirect(route('videos.table', $playlist->slug));
    }

    public function destroy(Playlist $playlist, Video $video)
    {
        $this->authorize('policy', $playlist);
        $video->delete();
        return redirect(route('videos.table', $playlist->slug));
    }

    // front end
    public function index(Playlist $playlist)
    {
        $videos = $playlist->videos()->orderBy('episode')->get();
        return (VideoResource::collection($videos))->additional(compact('playlist'));
    }

    public function show(Playlist $playlist, Video $video)
    {
        if (Auth::user()->hasbought($playlist) || $video->intro == 1)
        {
             return (new VideoResource($video))->additional(compact('playlist'));
        }

        return response()->json(['message' => 'You have to buy before watching'], 401);
    }
}
 