<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

function ValidateUserSession($redirectOnSuccess, $privilege,$redirectOnFail=null)
{
    if (Auth::user()->role->rolePrivileges[$privilege]) {
        return $redirectOnSuccess;
    }
    else if ($redirectOnFail)
        return $redirectOnFail;
    else
        return redirect(route('login'));

}
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
