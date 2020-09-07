<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

function ValidateUserSession($redirectOnTrue, $privilege)
{
    if (Auth::user()->role->rolePrivileges[$privilege]) {
        return $redirectOnTrue;
    }
    else return redirect(route('login'));
}
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
