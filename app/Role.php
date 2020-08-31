<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{






    public function rolePrivileges()
    {
        return $this->hasOne(RolePrivileges::class);
    }
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }
}
