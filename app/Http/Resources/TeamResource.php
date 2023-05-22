<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country' => CountryResource::make($this->country),
            'balance' => $this->balance,
            'name' => $this->name,
            'players' => PlayerResource::collection($this->players),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
