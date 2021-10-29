<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        // Create Token

        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out']);
    }

    public function login(Request $request)
    {
        
        // Check email
        $user = User::where('email', $request->email)->first();
        

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Bad login'], 401);
        }
        // Create Token

        $token = $user->createToken('mytoken')->plainTextToken; 

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    
}

//1|1Bo409gQ5ssDnGdYIKUQTc9ri0KHgjSKMzNKhbNa

//1|NXD7DgR135FnKrlWDGXuxIQtcETImVOOFzh9Nlry
