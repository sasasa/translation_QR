<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    const NONE = 0;
    const BROWSING = 5;
    const EDITING = 9;

    public static $permissions = [
        self::NONE => '権限無し',
        self::BROWSING => '閲覧権限',
        self::EDITING => '編集権限',
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];
    public static $update_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
    ];
    public static $update_pass_rules = [
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPermissionJpAttribute()
    {
        return self::$permissions[$this->permission];
    }
}
