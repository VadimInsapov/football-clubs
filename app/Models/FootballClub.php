<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FootballClub extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $casts = [
        'date_created' => 'datetime:Y-m-d',
    ];
    protected $guarded = [];
    public function getYearAttribute()
    {
        return date('Y', strtotime($this->date_created));
    }
    public function club_head()
    {
        return $this->belongsTo(ClubHead::class);
    }
    public function user()
    {
        return $this->belongsto(User::class);
    }
}
