<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Screencast\Playlist;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_id',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
