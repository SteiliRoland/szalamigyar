<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Szalamik extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id"=>$this->id,
            "termeknev"=>$this->termeknev,
            "ar"=>$this->ar,
            "alapanyag"=>$this->alapanyag,
            "gyartasi_ido"=>$this->gyartasi_ido->format("m/d/y")            
        ];
    }
}
