<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentaras extends Model
{
    protected $table = 'komentaras';

    protected $fillable = ['id', 'turinys', 'sukurimo_data', 'useris', 'email', 'fk_Straipsnis_id'];

        /* nurodome kad  nenaudosime created_at ir updated_at laukų šiame modulyje*/
        public $timestamps = false;

        public function straipsnis()
    {
        return $this->belongsTo('App\Straipsnis', 'fk_Straipsnis_id', 'id');
        //youtubej dare kaip apacioj ir veike
        //return $this->belongsTo('App\Straipsnis');
    }
}
