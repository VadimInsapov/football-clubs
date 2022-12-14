<?php

namespace App\Http\Controllers;

use App\Models\ClubHead;
use App\Models\FootballClub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FootballClubController extends Controller
{
    public function index()
    {
        $clubs = FootballClub::all();
        return view('football_clubs.index', compact('clubs'));
    }

    public function create()
    {
        $user = Auth::user();
        $club = new FootballClub();
        $head = new ClubHead();
        $club->club_head_id = $head->id;
        return view('football_clubs.create', compact('club', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $this->validatedData();
        $lastHead = $this->getNewHeader();

        $club = new FootballClub();
        $this->setLogo($club, $request);
        $club->name = request('name');
        $club->country = request('country');
        $club->date_created = request('date');
        $club->club_head_id = $lastHead->id;
        $club->user_id = $user->id;

        $club->save();
        return redirect(route('user.index', ['user' => $user]));
    }

    public function show($clubId)
    {
        $user = Auth::user();
        $club = FootballClub::withTrashed()->find($clubId);
        $matches = $club->matches()->get();
        return view('football_clubs.show', compact('club', 'user','matches'));
    }
    public function edit(FootballClub $club)
    {
        if (!$this->canEdit($club)) return response("You can't edit it", 403);
        $user = Auth::user();
        return view('football_clubs.edit', compact('club', 'user'));
    }
    public function update(FootballClub $club, Request $request)
    {
        if (!$this->canEdit($club)) return response("You can't update it", 403);

        $data = $this->validatedData();
        $club->name = request('name');
        $club->country = request('country');
        $lastHead = $this->getNewHeader();
        $club->club_head_id = $lastHead->id;
        $club->date_created = request('date');
        $this->setLogo($club, $request);
        $club->update();
        $user = Auth::user();
        return redirect(route('user.index', ['user' => $user]));
    }
    public function destroy(FootballClub $club)
    {
        if (!$this->canEdit($club)) return response("You can't destroy  it", 403);
        $club->delete();
        $user = Auth::user();
        return redirect(route('user.index', ['user' => $user]));
    }
    public function destroyByAdmin(FootballClub $club)
    {
        $club->forceDelete();
        $user = Auth::user();
        return redirect(route('user.index', ['user' => $user]));
    }

    public function restore($clubId)
    {
        FootballClub::withTrashed()->find($clubId)->restore();
        $user = Auth::user();
        return redirect(route('user.index', ['user' => $user]));
    }

    public function canEdit(FootballClub $club)
    {
        return Gate::allows('edit-club', $club);
    }

    public function canAdd()
    {
        return Gate::allows('add-club');
    }

    public function validatedData()
    {
        return request()->validate([
            'name' => 'required',
            'country' => 'required',
            'date' => 'required',
            'logo' => 'image|mimes:png,svg',
            'header' => 'regex:/.+? .+?/',
        ]);
    }

    public function getNewHeader()
    {
        $header = new ClubHead();
        $headerFullName = explode(" ", request('header'));
        $header->first_name = $headerFullName[0];
        $header->last_name = $headerFullName[1];
        $header->save();

        $headers = ClubHead::all();
        $lastHead = collect($headers)->last();
        return $lastHead;
    }

    public function setLogo(FootballClub $club, Request $request)
    {
        if ($request->file('logo')) {
            $club->logo = 'storage/' . $request->file('logo')->store('', 'public');
        }
    }
}
