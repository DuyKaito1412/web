<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ho_ten' => $this->ho_ten,
            'so_dien_thoai' => $this->so_dien_thoai,
            'dia_chi' => $this->dia_chi,
            'vai_tro' => $this->vai_tro,
        ];
    }
}
