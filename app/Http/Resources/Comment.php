<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            'turinys' => $this->turinys,
            'sukurimo_data' => $this->sukurimo_data,
            'useris' => $this->useris,
            'email' => $this->email,
            'fk_Straipsnis_id' => $this->fk_Straipsnis_id,
        ];
    }
}
