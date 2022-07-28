<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'stadium' => $this->stadium,
            'date_game' => $this->date_game,
            'user_id' => $this->user_id,
            'football_club_id' => $this->football_club_id,
            //данные основной сущности в вывод этого ресурса
            'is_friend' => Auth::user()->isFriend(User::find($this->user_id)),
            'football_club_name' => $this->football_club(),
        ];
    }
}
