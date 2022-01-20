<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
