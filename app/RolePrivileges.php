<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePrivileges extends Model
{
    public function privileges()
    {
        return $this->belongsTo(Privileges::class);
    }
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
