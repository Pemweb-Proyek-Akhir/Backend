<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Users $user, Request $request)
    {
        try {
            $uid = $request['user_data']['id'];
            $data = $user::find($uid);
            if ($data == null) {
                return ResponseHelper::err("Error while retrieving data");
            }
            return ResponseHelper::baseResponse("Success get data", 200, $data);
        } catch (Exception $err) {
            return ResponseHelper::err($err->getMessage());
        }
    }

    public function updateProfilePhoto(Request $request)
    {
        try {
            $uid = $request['user_data']['id'];

            $request->validate([
                "image" => "required|image|mimes:jpeg,png,jpg"
            ]);

            $this->validate($request, [
                "image" => "required|image|mimes:jpeg,png,jpg"
            ]);

            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');
            $path = '/api/public/images/' . $filename;
            $HOST = $_SERVER['HTTP_HOST'];
            $url = $HOST . $path;

            $user = Users::find($uid)->update(['profile_picture' => $url]);

            return ResponseHelper::baseResponse("Success update profile photo", 200, $user);
        } catch (Exception $err) {
            return ResponseHelper::err($err->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        //
    }
}
