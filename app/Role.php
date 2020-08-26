<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{






    public function RolePrivileges()
    {
        return $this->hasMany(RolePrivileges::class);
    }
    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }
}
