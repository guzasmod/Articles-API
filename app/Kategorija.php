<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = 'straipsnio_kategorija';

    protected $fillable = ['id', 'pavadinimas'];

        /* nurodome kad  nenaudosime created_at ir updated_at laukų šiame modulyje*/
        public $timestamps = false;

        public function straipsniai()
    {
        return $this->hasMany('App\Straipsnis', 'fk_Straipsnio_kategorija_id', 'id');
    }
}
