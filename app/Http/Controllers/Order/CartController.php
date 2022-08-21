<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Screencast\Playlist;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Order\CartResource;
use App\Models\Order\Cart;

class CartController extends Controller
{
    public function store(Playlist $playlist)
    {
        if(!Auth::user()->alreadyInCart($playlist)) {
                $cart = Auth::user()->carts()->create([
                    'playlist_id' => $playlist->id,
                    'price' => $playlist->price,
                ]);

                return response()->json([
                    'message' => 'Added to cart',
                    'data' => $cart,
                ]);  
        } else {
            return response()->json([
                'message' => 'playlist already in cart',
            ], 422);  
        }
    }

    public function index()
    {
        return CartResource::collection(Auth::user()->carts()->with('playlist', 'user')->latest()->get());
    }

        public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
            'message' => 'Your cart has been removed',
        ]);
    }
}

