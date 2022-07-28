<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    function login(Request $request) {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials.']);
        }
        $user = $request->user();
        if ($user) {
            if ($user->token == null) {
                $accessToken = $user->createToken('token')->accessToken;
                DB::table('users')->where('id', $user->id)->update(['token' => $accessToken]);
                return response(['user' => Auth::user(), 'access_token' => $accessToken]);
            }
            return response(['message' => 'Token already exists.', 'access_token' => $user->token]);
        }
        return response(['message' => 'No user found in the database.']);
    }
}
