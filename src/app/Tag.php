<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
