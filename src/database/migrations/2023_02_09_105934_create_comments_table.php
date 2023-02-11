<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('postId');
            // $table->foreign('postId')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();

            //$table->unsignedBigInteger('userId');
            // $table->foreign('userId')->references('id')->on('users')->cascadeOnDelete();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            $table->text('body');
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
        Schema::dropIfExists('comments');
    }
};
