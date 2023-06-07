<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->text('details')->nullable();
            $table->string('post_img')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->cascadeOnUpdate()->cascadeOnUpdate();
            // $table->foreignId('category_id')
            //     ->constrained('categories');
            $table->enum('type', [0, 1])->default(0);

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
        Schema::dropIfExists('posts');
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('category_id');
        });
    }
}
