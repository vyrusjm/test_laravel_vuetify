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
    ];

    public function isAdmin()
    {
        return $this->admin == User::USER_ADMIN;
    }
}
