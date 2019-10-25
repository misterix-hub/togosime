<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function categorieImage(){
        return $this->belongsTo('App\CategorieImage');
    }
}
