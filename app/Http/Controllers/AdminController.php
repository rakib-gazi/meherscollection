<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
    function AddUser(Request $request){
        $data = $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:30',

        ]);
        User::create($data);
        return Inertia::render('Register', [
            'success' => 'User created successfully.',
        ]);
    }
    function  AddProduct(Request $request)
    {
        return Inertia::render('AddProduct');
    }
}
