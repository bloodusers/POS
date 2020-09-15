<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

function ValidateUserSession($redirectOnSuccess, $privileges, $redirectOnFail = null)
{
    if (is_array($privileges) || is_object($privileges)) {
        foreach ($privileges as $privilege) {
            if (Auth::user()->role->rolePrivileges[$privilege]) {
                {
                }
            } else if ($redirectOnFail)
                return $redirectOnFail;
            else
                return redirect(route('login'));
        }
    }
    return $redirectOnSuccess;
}

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
