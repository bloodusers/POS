<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
   /* protected $guarded = [
        'name' => 'required',
        'shortName' => 'required',
        'contactPerson' => 'required',
        'contact' => 'required|min:11|numeric',
        'email' => 'required|email:rfc,dns',
        'regDate' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required',
    ];*/

    protected $fillable = [
        'name', 'email', 'password','shortName', 'contactPerson', 'contact', 'regDate',
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
   /* public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }*/
}
