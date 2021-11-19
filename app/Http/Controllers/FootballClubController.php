<?php

namespace App\Http\Controllers;

use App\Models\ClubHead;
use App\Models\FootballClub;
use Illuminate\Http\Request;

class FootballClubController extends Controller
{
    public function index()
    {
        $clubs = FootballClub::all();
        return view('football_clubs.index', compact('clubs'));
    }

    public function create()
    {
        $club = new FootballClub();
        $head = new ClubHead();
        $club->club_head_id = $head->id;
        return view('football_clubs.create', compact('club'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData();
        $lastHead = $this->getNewHeader();

        $club = new FootballClub();
        $this->setLogo($club, $request);
        $club->name = request('name');
        $club->country = request('country');
        $club->date_created = request('date');
        $club->club_head_id = $lastHead->id;
        $club->save();
        return redirect('/clubs');;
    }

    public function show(FootballClub $club)
    {
        return view('football_clubs.show', compact('club'));
    }

    public function edit(FootballClub $club)
    {
        return view('football_clubs.edit', compact('club'));
    }

    public function update(FootballClub $club, Request $request)
    {
        $data = $this->validatedData();
        $club->name = request('name');
        $club->country = request('country');
        $lastHead = $this->getNewHeader();
        $club->club_head_id = $lastHead->id;
        $club->date_created = request('date');
        $this->setLogo($club, $request);
        $club->update();
        return redirect('/clubs');
    }

    public function destroy(FootballClub $club)
    {
        $club->delete();
        return redirect('/clubs');
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
