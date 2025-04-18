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
    function AddUser(Request $request){
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'firstName' => 'required|string|max:50| min:3',
                'lastName' => 'required|string|max:50| min:3',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|string|unique:users,mobile|min:11|max:14',
                'password' => 'required|string|min:6',
                'role' => 'required|string|max:30',

            ]);
            User::create($data);
            DB::commit();
            return Inertia::render('Register', [
                'success' => 'User created successfully.',
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
    function getAllUsers()
    {
        $users =  User::get();
        return Inertia::render('AllUser', ['users' => $users]);
    }
    function  AddProduct(Request $request)
    {
        return Inertia::render('AddProduct');
    }
}
