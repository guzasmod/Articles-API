<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Straipsnis extends Model
{
    protected $table = 'straipsnis';

    protected $fillable = ['id', 'pavadinimas', 'santrauka', 'turinys','sukurimo_data', 'fk_Straipsnio_kategorija_id'];
  
    /* nurodome kad  nenaudosime created_at ir updated_at laukų šiame modulyje*/
    public $timestamps = false;

    public function comments()
    {
        //return $this->hasMany('App\Komentaras');
        return $this->hasMany('App\Komentaras', 'fk_Straipsnis_id', 'id');
    }

    public function category()
    {
       // return $this->belongsTo('App\Kategorija', 'fk_Straipsnio_kategorija_id');
        return $this->belongsTo('App\Kategorija');
    }
}
