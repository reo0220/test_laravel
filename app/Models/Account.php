<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'accounts';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //accountsテーブルのカラム名（自動採番・登録されるカラム以外）
    protected $fillable = [
        'id',
        'family_name',
        'last_name',
        'family_name_kana',
        'last_name_kana',
        'mail',
        'password',
        'gender',
        'postal_code',
        'prefecture',
        'address_1',
        'address_2',
        'authority',
        'delete_flag',
        'registered_time',
        'update_time'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed'
    ];
}