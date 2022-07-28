<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\FootballClub;
use App\Models\MyMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\APIBaseController as BaseController;
class APIMatchController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MatchResource::collection(MyMatch::all());
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
        request()->validate([
            'stadium' => 'required',
            'date_game' => 'required',
            'football_club_id' => 'required',
        ]);
        $match = new MyMatch();
        $match->stadium = request('stadium');
        $match->date_game = request('date_game');
        $match->football_club_id = request('football_club_id');
        $match->user_id = Auth::user()->id;
        $match->save();
        return $this->sendResponse($match->toArray(), 'Match created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $match = MyMatch::find($id);
        $match->stadium = request('stadium');
        $match->date_game = request('date_game');
        $match->football_club_id = request('football_club_id');
        $match->update();
        return $this->sendResponse($match->toArray(), 'Match updated successfully.');
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
