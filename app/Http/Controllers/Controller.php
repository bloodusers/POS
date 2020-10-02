<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getFeild($f,$table,$where)
{
    //DB::table('categories')->where('title', 'LIKE', '%' . $request->invoice . "%")->get();
    //$result=DB::table($table)->select($f)->where($where)->get();
    $result=DB::select(DB::raw("SELECT $f FROM $table WHERE $where"));
    $temp=array();
    foreach ($result as $res)
    {
        array_push($temp,$res->id);
    }
    return $temp;
}
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
