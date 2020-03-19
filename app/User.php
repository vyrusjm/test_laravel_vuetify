<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const USER_ADMIN = 'true';
    const USER_REGULAR = 'false';
    const USER_VERIFIED = '1';
    const USER_NOT_VERIFIED = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'admin',
        'verified',
        'verification_token',
    ];

    //transforming the string into lowercase
    public function setNameAtrribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    // capitalizing the first letter of each word
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
     //transforming the email into lowercase
     public function setEmailAtrribute($value)
     {
         $this->attributes['email'] = strtolower($value);
     }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    public function isVerified()
    {
        return $this->verified == User::USER_VERIFIED;
    }
    public function isAdmin()
    {
        return $this->admin == User::USER_ADMIN;
    }
    public static function generateVerificationToken()
    {
        return Str::random(56);
    }
}
