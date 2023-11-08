<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required',
            "password" => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        }
        $user_exist = User::where('email', $request->email)->first();
        if ($user_exist) {
            return response([
                "message" => "email has been use",
                "statue" => false
            ]);
        }
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        return response([
            "message" => "create account successfully",
            "user" => $user,
        ]);
    }

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => 'required',
            "password" => 'required'
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $user_exist = User::where('email', $request->email)->first();
        if (!$user_exist) {
            return response([
                "message" => "User not found",
                "statue" => false
            ]);
        }
        if (Hash::check($request->password, $user_exist->password)) {
            $access_token = $user_exist->createToken("Token User")->plainTextToken;
            return response([
                "message" => true,
                "user" => $user_exist,
                "token" => $access_token
            ]);
        }
    }

    public function AllPost()
    {
        if (Auth()->user()) {
            $allPost = PostModel::all();
            return response([
                "statue" => "successfully",
                "success" => true,
                "data" => PostResource::collection($allPost),
            ]);
        } else {
            return response([
                "status" => "User Anthorized",
                "success" => false
            ]);
        }
    }

    public function PostProfile(Request $request)
    {
        if (Auth()->user()) {
            $request->validate([
                "image" => 'required',
                "description" => 'required',
            ]);
            $image_path = $request->file('image')->store('image', 'public');
            $postModel = PostModel::create([
                "image" => $image_path,
                "description" => $request->description,
            ]);
            return response([
                "statue" => "successfuly",
                "success" => true,
                "data" => $postModel
            ]);
        } else {
            return response([
                "status" => "User Anthorized",
                "success" => false
            ]);
        }
    }
}
