<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubHead extends Model
{
    use HasFactory;
    public function football_club()
    {
        return $this->hasOne(FootballClub::class);
    }
}
