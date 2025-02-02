<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        //if you want specific data to return
        return [
            'id' => $this->id,
            'pavadinimas' => $this->pavadinimas,
            'straipsniai' => $this->straipsniai,
        ];
    }
}
