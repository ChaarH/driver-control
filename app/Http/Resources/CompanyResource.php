<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'logo'       => $this->logo,
            'created_at' => $this->created_at->diffForHumans(),
            'deleted_at' => $this->deleted_at,
            'total_users' => User::where('company_id', $this->id)->count()
        ];
    }
}
