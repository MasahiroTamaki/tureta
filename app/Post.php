<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
   * リレーション (従属の関係)
   */
  public function user()  // 単数形
  {
    return $this->belongsTo('App\User');
  }
}
