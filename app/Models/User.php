<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Screencast\Playlist;
use App\Models\Order\Cart;
use App\Models\Order\Order;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function gravatar()
    {
        return 'picture'; 
    }

    public function purchases()
    { 
        return $this->belongsToMany(Playlist::class, 'purchased_playlist', 'user_id', 'playlist_id')->withTimestamps(); 
    }

    public function buy(Playlist $playlist)
    { 
        return $this->purchases()->save($playlist);
    }

    public function hasBought(Playlist $playlist)
    { 
        return (bool) $this->purchases()->find($playlist->id);
    }
 
    public function carts()
    { 
        return $this->hasMany(Cart::class);
    }

    public function alreadyInCart(Playlist $playlist)
    {
        return (bool) $this->carts()->where('playlist_id', $playlist->id)->first();
    }

    public function orders()
    { 
        return $this->hasMany(Order::class);
    }

        public function addToCart(Playlist $playlist)
    { 
        return $this->carts()->create([
            'playlist_id' => $playlist->id,
            'price' => $playlist->price,
        ])->load('playlist');
    }
}
