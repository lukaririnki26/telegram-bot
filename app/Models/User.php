<?php

namespace App\Models;

use App\Models\Traits\MediaTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use MediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sys_users';

    protected $fillable = [
        'name',
        'email',
        'msisdn',
        'password',
        'language',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute()
    {
        return $this->getMediaUrl('avatar');
    }

    public function getFlagAttribute()
    {
        return match ($this->language) {
            'en' => 'https://flagcdn.com/40x30/us.png',
            'id' => 'https://flagcdn.com/40x30/id.png',
            default => 'https://flagcdn.com/40x30/us.png',
        };
    }
}
