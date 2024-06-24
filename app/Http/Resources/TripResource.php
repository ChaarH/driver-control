<?php

namespace App\Http\Resources;

use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'driver_id'     => $this->driver_id,
            'company_id'    => $this->company_id,
            'price'         => $this->price,
            'city_from'     => $this->city_from,
            'city_to'       => $this->city_to,
            'district_from' => $this->district_from,
            'district_to'   => $this->district_to,
            'address_from'  => $this->address_from,
            'address_to'    => $this->address_to,
            'started_at'    => Carbon::parse($this->started_at)->format('d/m/Y H:i:s'),
            'ended_at'      => Carbon::parse($this->ended_at)->format('d/m/Y H:i:s'),
            'driver_info'   => Driver::where('id', $this->driver_id)->first()
        ];
    }
}
