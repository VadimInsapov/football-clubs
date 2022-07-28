<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\FootballClubController;
use App\Models\ClubHead;
use App\Models\FootballClub;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\APIBaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;
class APIFootballClubController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = FootballClub::all();
        return $this->sendResponse($clubs->toArray(), 'FootballClubs retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $lastHead = $this->getNewHeader();

        $club = new FootballClub();
        $club->name = request('name');
        $club->country = request('country');
        $club->date_created = request('date');
        $club->club_head_id = $lastHead->id;
        $club->user_id = $user->id;
        $club->save();
        return $this->sendResponse($club->toArray(), 'FootballClubs created successfully.');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $club = FootballClub::withTrashed()->find($id);
        $club->name = request('name');
        $club->country = request('country');
        $club->date_created = request('date');
        $lastHead = $this->getNewHeader();
        $club->club_head_id = $lastHead->id;
        $club->update();
        return $this->sendResponse($club->toArray(), 'FootballClub updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
