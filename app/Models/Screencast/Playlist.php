<?php

namespace App\Models\Screencast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'thumbnail',
    ];

    protected $withCount = ['videos'];

    public function tags()
    {
        // playlist bisa memiliki banyak tags
        return $this->belongsToMany(Tag::class);
    }

    public function videos()
    {
        // playlis boleh memiliki banyak video
        return $this->hasMany(Video::class);   
    }

    public function user()
    {
        // playlis hanya bisa dimiliki 1 user
        return $this->belongsTo(User::class);
    }

    public function getPictureAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }

    public function purchasesBy()
    {
         // playlist bisa memiliki banyak purchasesBy
        return $this->belongsToMany(User::class, 'purchased_playlist', 'user_id', 'playlist_id'); 
    }
}
