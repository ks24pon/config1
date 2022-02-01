<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTagTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('article_tag', function (Blueprint $table) {
      // タグの紐付けを識別するID
      $table->bigIncrements('id');
      // タグがつけられた記事のID
      $table->bigInteger('article_id')->unsigned();
      // 外部キー制約(article_tagテーブルのarticle_idはarticlesテーブルのidを参照。onDeleteでarticlesテーブルのレコードが削除すれば同時に削除)
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      // 外部キー制約(article_tagテーブルのtag_idはtagsテーブルはidを参照。onDeleteはtagsテーブルのレコードが削除なら同時に削除)
      $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
      // 記事につけられたID
      $table->bigInteger('tag_id')->unsigned();
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
    Schema::dropIfExists('article_tag');
  }
}
