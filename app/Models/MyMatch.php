<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyMatch extends Model
{
    protected $table = 'matches';
    use HasFactory;

    protected $casts = [
        'date_game' => 'datetime:Y-m-d',
    ];
    protected $guarded = [];

    public function football_club()
    {
        return $this->belongsTo(FootballClub::class)->get()[0];
    }

    public function user()
    {
        return $this->belongsTo(User::class)->get()[0];
    }

    public function getDateGame()
    {
        return date('Y-m-d', strtotime($this->date_game));
    }
}
