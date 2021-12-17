<?php

namespace App\Http\Controllers;

use App\Models\ClubHead;
use App\Models\FootballClub;
use App\Models\MyMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function create($clubId)
    {
        $user = Auth::user();
        $match = new MyMatch();
        return view('matches.create', compact('match','user', 'clubId'));
    }
    public function store($clubId, Request $request)
    {
        $user = Auth::user();
        $this->validatedData();
        $match = new MyMatch();
        $match->date_game = request('date');
        $match->stadium = request('stadium');
        $match->user_id = Auth::user()->id;
        $match->football_club_id = $clubId;
        $match->save();
        return redirect(route('user.index', ['user' => $user]));
    }
    public function validatedData()
    {
        return request()->validate([
            'stadium' => 'required',
            'date' => 'required',
        ]);
    }
}
