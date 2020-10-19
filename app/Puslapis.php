<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puslapis extends Model
{
    protected $table = 'puslapis';

    protected $fillable = ['id', 'pavadinimas', 'turinys'];

        /* nurodome kad  nenaudosime created_at ir updated_at laukų šiame modulyje*/
        public $timestamps = false;  
}
