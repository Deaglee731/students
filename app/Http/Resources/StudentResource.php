<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            'group' => new GroupResource($this->group),
            'birthday' => $this->birthday,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'score' => ScoreResource::collection($this->subjects),
            'updated_at' => $this->updated_at,
        ];
    }
}
