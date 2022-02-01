<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
  protected $fillable = [
    'name',
  ];
  // #のアクセサを作成
  public function getHashtagAttribute(): string
  {
    return '#' . $this->name;
  }
  // タグモデルに記事モデルへのリレーションを追加
  public function articles(): BelongsToMany
  {
    return $this->belongsToMany('App\Article')->withTimestamps();
  }
}
