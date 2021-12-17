<?php

namespace App\Http\Controllers;

use App\Models\FootballClub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function indexByUser(User $user)
    {
        $clubs = FootballClub::where('user_id', $user->id)->get();
        $authUser = Auth::user();
        if ($user->is_admin && $authUser->is_admin) {
            $clubs = FootballClub::withTrashed()
                ->select('users.name as userName', 'football_clubs.*')
                ->join('users', function ($join) {
                    $join->on('football_clubs.user_id', '=', 'users.id');
                })->get();
        }
        $currentUser = $user;
        return view('football_clubs.index', compact('clubs', 'currentUser'));
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function subscribe($userId)
    {
        $user = User::find($userId);
        Auth::user()->addFriend($user);
        return Redirect::back();
    }

    public function unsubscribe($userId)
    {
        $user = User::find($userId);
        Auth::user()->removeFriend($user);
        return Redirect::back();
    }

    public function ribbon($userId)
    {
        $user = User::find($userId);
        $matches = $user->matchesByFriends();
        return view('users.ribbon', compact('matches'));
    }
}
