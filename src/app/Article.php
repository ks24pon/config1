<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
  // 不正利用対策
  protected $fillable = [
    'title',
    'body',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo('App\User');
  }
  // いいねにおける記事モデルとユーザーモデルの関係は多対多
  public function likes(): BelongsToMany
  {
    return $this->belongsToMany('App\User', 'likes')->withTimestamps();
  }
  // nullableな型宣言を行いnullも渡せるように実装
  public function isLikedBy(?User $user): bool
  {
    // 三項演算子を利用
    return $user
      ? (bool)$this->likes->where('id', $user->id)->count()
      : false;
  }
  // いいねの合計を算出
  public function getCountLikesAttribute(): int
  {
    // countメソッドを使ってコレクションの要素数を数える
    return $this->likes->count();
  }

  // 記事モデルとタグモデルの関係は多対多の関係
  public function tags(): BelongsToMany
  {
    return $this->belongsToMany('App\Tag')->withTimestamps();
  }
}
