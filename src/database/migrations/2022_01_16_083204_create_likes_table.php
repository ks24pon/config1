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
      // 外部キー制約(likesテーブルのuser_idカラムはusersテーブルのidカラムを参照する。)
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->bigInteger('article_id')->unsigned();
      // 外部キー制約(likesテーブルのarticle_idはarticlesテーブルのidを参照する。)
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      // 作成・更新日時
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
