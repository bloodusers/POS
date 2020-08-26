<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
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
        'name', 'email', 'contact', 'org_id', 'role_id', 'password',
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

    public function Role()
    {
        return $this->hasOne(Role::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
