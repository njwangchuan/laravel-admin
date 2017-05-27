<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
  use EntrustUserTrait;

  protected $fillable = array('username', 'display_name', 'phone', 'email', 'job','referee','address','register_fee','org', 'grade', 'password', 'confirmation_code', 'confirmed', 'pay_status');

  protected $hidden = [
    'password', 'remember_token',
  ];

  public function wechat_user()
  {
    return $this->hasOne('App\Models\WechatUser');
  }
}
