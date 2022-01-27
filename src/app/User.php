<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // ユーザーとそのユーザーの投稿した記事は１対多の関係
  public function articles(): HasMany
  {
    return $this->hasMany('App\Article');
  }

  public function followers(): BelongsToMany
  {
    return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
  }

  // これからフォローするユーザー、フォロー中のユーザーのモデル
  public function followings(): BelongsToMany
  {
    return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
  }
  // nullを許容
  public function isFollowedBy(?User $user): bool
  {
    // 三項演算子の利用
    return $user
      ? (bool)$this->followers->where('id', $user->id)->count()
      : false;
  }

  public function getCountFollowersAttribute(): int
  {
    // countメソッドで要素数を数える
    return $this->followers->count();
  }

  public function getCountFollowingsAttribute(): int
  {
    return $this->followings->count();
  }
}
