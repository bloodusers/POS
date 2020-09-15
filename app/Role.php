<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function rolePrivileges()
    {
        return $this->hasOne(RolePrivileges::class);
        /* if ($privilege(Auth::user()->role->rolePrivileges)) {
                {
                }*/
    }
    public function User()
    {
        return $this->hasMany(User::class);
    }
}
