<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
