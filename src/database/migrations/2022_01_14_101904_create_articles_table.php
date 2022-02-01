<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles', function (Blueprint $table) {
      // 記事を識別するID
      $table->bigIncrements('id');
      //記事のタイトル
      $table->string('title');
      // 記事を投稿したユーザーのID
      $table->bigInteger('user_id')->unsigned();
      //外部キー制約（articlesテーブルのuser_idはusersテーブルのidを参照)
      $table->foreign('user_id')->references('id')->on('users');
      // 採用形態ボタン
      $table->bigInteger('recruitment_id');
      // 試験項目ボタン
      $table->bigInteger('test_id');
      //試験内容
      $table->text('contents_test');
      // その他の情報
      $table->text('other_information');
      //アドバイスなど
      $table->text('advice_etc');
      //作成・更新日時
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
    Schema::dropIfExists('articles');
  }
}
