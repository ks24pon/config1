<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('likes', function (Blueprint $table) {
      // いいねを識別するID
      $table->bigIncrements('id');
      $table->bigInteger('user_id')->unsigned();
      // 外部キー制約
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->bigInteger('article_id')->unsigned();
      // 外部キー制約
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

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
    Schema::dropIfExists('likes');
  }
}
