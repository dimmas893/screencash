<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_playlist', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('playlist_id');
            // $table->primary('playlist_id', 'user_id');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('playlist_id')->constrained('playlists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_playlist');
    }
}
