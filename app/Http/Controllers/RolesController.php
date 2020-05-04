<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->hasRole(Role::ADMIN_ROLE_NAME)){
            return Role::all();
        }
    }
}
