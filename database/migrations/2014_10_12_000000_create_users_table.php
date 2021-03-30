<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Album;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained();
        });

        // $admin = User::where('name', '=', 'admin@usc.edu')->first();

        $albums = Album::all();

        foreach($albums as $album) {
            // $album->user_id = $admin->id
            $album->user_id = 2;
            $album->save();
        }    
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('albums', ['user_id']);
        Schema::dropIfExists('users');
    }
}
