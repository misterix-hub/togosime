<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request) {
        // return '';
        $validation = $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function login() {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            $success['token'] = $user->createToken('MyApp')->accessToken;

            return response()->json(['success'=>$success, 'user'=>$user], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
