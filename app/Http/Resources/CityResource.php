<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                              => $this->id,
            'name'                            => $this->name,
            'trip_price'                      => $this->trip_price,
            'increase_time_start'             => $this->increase_time_start,
            'increase_time_end'               => $this->increase_time_end,
            'trip_price_increased_after_time' => $this->trip_price_increased_after_time,
            'default'                         => $this->default,
            'created_at'                      => $this->created_at->diffForHumans()
        ];
    }
}
