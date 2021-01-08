<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Chat extends JsonResource
{

    public $collects = Chat::class;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $usersCount = $this->users->count();
        $other = $this->users->except([$request->user()->id])->first();

        if ($this->name)
            $name = $this->name;
        else if ($usersCount == 2)
            $name = $other->email;
        else
            $name = $usersCount . ' участников';

        return [
            'id' => $this->id,
            'name' => $name,
            'users_count' => $usersCount,
            'users' => $this->users,
            'messages' => Message::collection($this->whenLoaded('messages'))
        ];
    }
}
