<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PhieuYeuCauResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            // Thêm các trường cần thiết
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
