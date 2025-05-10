<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    function AddUser(Request $request){


            $data = $request->validate([
                'firstName' => 'required|string|max:50|min:3',
                'lastName' => 'required|string|max:50|min:3',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|string|unique:users,mobile|min:11|max:14',
                'password' => 'required|string|min:6',
                'role' => 'required|string|max:30',

            ]);
        DB::beginTransaction();
        try {
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
    function getUser()
    {
        $users = User::all();
        return Inertia::render('AllUser', [
            'users' => $users,
        ]);
    }

    function updateUser(Request $request)
    {
        $id = $request->input('id');
        $data = $request->validate([
            'firstName' => 'required|string|max:50|min:3',
            'lastName' => 'required|string|max:50|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|string|unique:users,mobile,' . $id . '|min:11|max:14',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:30',
        ]);
        DB::beginTransaction();
        try {
            User::where('id', $id)->update($data);
            DB::commit();
            return Redirect::route('super-admin.all-users')->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    function deleteUser(Request $request)
    {
        $id = $request->id;
        Log::info($id);
        try {
            $deleted = User::where('id', $id)->delete();
            $error= '';
            if (!$deleted) {
                $error= 'User not found or could not be deleted.';
            }
            $data = ['message' => 'User Deleted Successfully', 'status' => true, 'error' => $error];
            return redirect()->route('AllUser')->with($data);
        } catch (Exception $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    function showLoginForm(Request $request)
    {
       return Inertia::render('Login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        Log::info('login', ['email' => $email, 'password' => $password]);
        $count = User::where('email', '=', $email)
            ->where('password', '=', $password)
            ->count();
        if ($count == 1) {
            $token = JWTToken::CreateToken($email);
            return redirect('super-admin')->with('token', $token)->cookie('token', $token, time() + 60 * 60 * 24);
        }
        else{
            return Redirect::back()->withErrors([
                'message' => 'Invalid email or password',
            ]);
        }

    }
    function logout(Request $request){
        return redirect('/login')->cookie('token', '', -1);
    }
}
