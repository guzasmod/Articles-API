<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        
        //if you want specific data to return
        return [
            'id' => $this->id,
            'pavadinimas' => $this->pavadinimas,
            'santrauka' => $this->santrauka,
            'turinys' => $this->turinys,
            'sukurimo_data' => $this->sukurimo_data,
            'fk_Straipsnio_kategorija_id' => $this->fk_Straipsnio_kategorija_id,
            'komentarai' => $this->comments,
        ];
        
    }

    /*
    public function with($request){
        return [
            'version' => '1.0.0',
            'author_url' => url('xd.com')
        ];
    }
    */
}
