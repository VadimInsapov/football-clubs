<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Array_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->hasMany(FootballClub::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends_users', 'user_id', 'friend_id');
    }

    public function matchesByFriends()
    {
        $array = array();
        foreach ($this->friends()->get() as $friend) {
            $matchesByOneFriend = $friend->matches()->get();
            $numbOfLastMatchByOneFriend = $matchesByOneFriend->count() - 1;
            if ($numbOfLastMatchByOneFriend != -1)
                array_push($array, $matchesByOneFriend[$numbOfLastMatchByOneFriend]);
        }
        return collect($array)->sortBy('created_at')->reverse();
    }

    public function matches()
    {
        return $this->hasMany(MyMatch::class);
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
        $user->friends()->attach($this->id);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
        $user->friends()->detach($this->id);
    }

    public function getFriend(User $user)
    {
        return $this->friends()->find($user);
    }
    public function isFriend(User $user)
    {
        return ($this->friends()->find($user) == null) ? false : true;
    }
}
