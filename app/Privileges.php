<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{




    public function rolePrivileges()
    {
        return $this->belongsTo(RolePrivileges::class);
    }
}
