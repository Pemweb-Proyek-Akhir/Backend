<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Users;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $validated = $this->validate($request, [
                "name" => 'required|max:255',
                "email" => 'required|email|max:255|unique:users,email',
                'password' => 'required',
                'user_type' => 'required|integer|in:0,1',
            ]);

            $user = new Users();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->user_type = $validated['user_type'];
            $user->password = Hash::make($validated['password']);

            $user->save();

            return ResponseHelper::baseResponse("Account Success Created", 200, $user, null);
        } catch (Exception $err) {
            return ResponseHelper::baseResponse($err->getMessage(), 404);
        }
    }

    public function login(Request $request)
    {
        try {
            $validated = $this->validate($request, [
                "email" => "required",
                'password' => "required"
            ]);


            $user = Users::where('email', $validated['email'])->first();

            if (!$user) {
                return ResponseHelper::baseResponse("Email not found", 404);
            }


            if (!Hash::check($validated['password'], $user->password)) {
                return ResponseHelper::baseResponse("Your password is wrong", 404);
            }

            $payload = [
                'iat' => intval(microtime(true)),
                'exp' => intval(microtime(true)) + (60 * 60 * 1000),
                'uid' => $user->id
            ];

            $token = JWT::encode($payload, env("JWT_SECRET"), "HS256");
            return ResponseHelper::baseResponse("Login success", 200, $token);
        } catch (Exception $err) {
            return ResponseHelper::err($err->getMessage());
        }
    }
}
