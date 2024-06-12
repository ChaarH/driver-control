<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return [
//            'id'         => $this->id,
//            'user_id'    => $this->user_id,
//            'run_price'  => $this->run_price,
//            'pix'        => $this->pix,
//            'car_brand'  => $this->car_brand,
//            'online'     => $this->online,
//            'in_run'     => $this->in_run,
//            'created_at' => $this->created_at->diffForHumans()
//        ];
        return parent::toArray($request);
    }
}
