<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{




    public function RolePrivileges()
    {
        return $this->hasMany(RolePrivileges::class);
    }
}
