<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('follows', function (Blueprint $table) {
      $table->bigIncrements('id');
      // フォロワーのユーザーid
      $table->bigInteger('follower_id')->unsigned();
      // 外部キー制約(followsテーブルのfollower_idはusersテーブルのidを参照。onDeleteでusersテーブルのレコードが削除なると同時に削除)
      $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
      // フォローもユーザーid
      $table->bigInteger('followee_id')->unsigned();
      // 外部キー制約(followsテーブルのfollowee_idはusersテーブルのidを参照。onDeleteでusersテーブルのレコードが削除なると同時に削除)
      $table->foreign('followee_id')->references('id')->on('users')->onDelete('cascade');
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
    Schema::dropIfExists('follows');
  }
}
