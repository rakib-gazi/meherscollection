<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    function MainAdmin(Request $request)
    {
        return Inertia::render('SuperAdmin');
    }
    function Register(Request $request)
    {
        return Inertia::render('Register');
    }


    function  AddProduct(Request $request)
    {
        return Inertia::render('AddProduct');
    }
}
