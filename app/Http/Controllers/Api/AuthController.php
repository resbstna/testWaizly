<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Validator;


class AuthController extends BaseController
{
    public function login(Request $request)
    {
        // validation login
        $v = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        //check validation
        if ($v->fails()) {
            return $this->sendError('Validation Error.', $v->errors(), 422);
        }


        if (auth()->attempt($request->all())) {
            return response([
                'user' => auth()->user(),
                'access_token' => auth()->user()->createToken('authToken')->accessToken
            ], 200);
        }


        return response([
            'message' => 'This User does not exist'
        ], 401);
    }


    public function register(Request $request)
    {
        // validation register
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        //check validation
        if ($v->fails()) {
            return $this->sendError('Validation Error.', $v->errors(), 422);
        }

        // encryption password
        $user['password'] = Hash::make($request->password);
        $user = User::create($request->all());


        return $this->sendResponse($user, 'User register successfully.');
    }
}
