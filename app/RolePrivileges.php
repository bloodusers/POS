<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePrivileges extends Model
{
    public function Privileges()
    {
        return $this->hasMany(Privileges::class);
    }
    public function Roles()
    {
        return $this->hasMany(Role::class);
    }
    //}
}
