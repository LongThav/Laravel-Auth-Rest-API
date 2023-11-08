<?php

namespace App\Http\Controllers;

use App\Models\UserAppModel;
use Illuminate\Http\Request;
use Validator;

class UserAppController extends Controller
{
    public function AllUser()
    {
        $user = UserAppModel::all();
        return response([
            "status" => "response successfully",
            "data" => $user
        ]);
    }

    public function AddUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "email" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = UserAppModel::create([
            "username" => $request->username,
            "email" => $request->email
        ]);
        return response([
            "status" => "add user successfully",
            "data" => $user
        ]);
    }

    public function UpdateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "username" => "required",
            "email" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = UserAppModel::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        return response([
            "status" => "add user successfully",
            "data" => $user
        ]);
    }

    public function DeleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = UserAppModel::find($request->id);
        $user->delete();
        return response([
            "status" => "User has been delete",
        ]);
    }
}
