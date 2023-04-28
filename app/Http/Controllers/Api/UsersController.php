<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Validator;

class UsersController extends BaseController
{
    public function index(Request $request)
    {

        // check forbidden
        try {
            $this->authorize('isAdmin');
            // search user and paginate 10
            $user = User::where([
                ['name', '!=', Null],
                [function ($query) use ($request) {
                    if (($s = $request->s)) {
                        $query->orWhere('name', 'LIKE', '%' . $s . '%')
                            ->orWhere('email', 'LIKE', '%' . $s . '%')
                            ->get();
                    }
                }]
            ])->paginate(10);

            return $this->sendResponse($user, 'User retrieved successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('forbidden.', [], 403);
        }
    }

    public function store(Request $request)
    {

        // check forbidden
        try {
            $this->authorize('isAdmin');
            //add user
            $v = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'role' => 'required|string|max:255',
                'password' => ['required', Rules\Password::defaults()],
            ]);

            //check validation
            if ($v->fails()) {
                return $this->sendError('Validation Error.', $v->errors(), 422);
            }


            // encryption password
            $user['password'] = Hash::make($request->password);
            $user = User::create($request->all());

            return $this->sendResponse($user, 'User created successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('forbidden.', '', 403);
        }
    }

    public function show($id)
    {

        // check forbidden
        try {
            $this->authorize('isAdmin');
            // show user 
            $user = User::find($id);

            //check jika user tidak ada
            if (is_null($user)) {
                return $this->sendError('User not found.', [], 422);
            }

            return $this->sendResponse($user, 'User retrieved successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('forbidden.', [], 403);
        }
    }

    public function update(Request $request, User $user)
    {

        // check forbidden
        try {
            $this->authorize('isAdmin');
            // validation update
            $v = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'role' => 'required|string|max:255'
            ]);

            //check validation
            if ($v->fails()) {
                return $this->sendError('Validation Error.', $v->errors(), 422);
            }

            $user->name = $request->name;
            $user->role = $request->role;
            $user->save();

            return $this->sendResponse($user, 'User updated successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('forbidden.', [], 403);
        }
    }

    public function destroy(User $user)
    {
        // check forbidden
        try {
            $this->authorize('isAdmin');

            $user->delete();

            return $this->sendResponse($user, 'User deleted successfully.');
        } catch (\Exception $ex) {
            return $this->sendError('forbidden.', [], 403);
        }
    }
}
