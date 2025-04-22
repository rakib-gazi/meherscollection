<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    function getUser()
    {
        $users = User::all();
        return Inertia::render('AllUser', [
            'users' => $users,
        ]);
    }

    function updateUser(Request $request)
    {
        Log::info('Update User Request Data:', $request->all());
        DB::beginTransaction();
        try {
            $id = $request->input('id');
            $data = $request->validate([
                'firstName' => 'required|string|max:50|min:3',
                'lastName' => 'required|string|max:50|min:3',
                'email' => 'required|email|unique:users,email,' . $id,
                'mobile' => 'required|string|unique:users,mobile,' . $id . '|min:11|max:14',
                'password' => 'required|string|min:6',
                'role' => 'required|string|max:30',
            ]);

//            return response()->json(['id'=> $id, 'data'=>$data]);


            User::where('id', $id)->update($data);


            DB::commit();

            return Inertia::render('AllUser', [
                'users' => User::all(),
                'success' => 'User Updated Successfully',

            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

}
