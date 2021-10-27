<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdministrator extends Controller
{
    public function viewAdministrator(){
        $admin = User::whereRoleIs('superadministrator')->get();
        return view('pages.superadmin.view-admin',compact('admin'));
    }
}
