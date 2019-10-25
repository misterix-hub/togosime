<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GammeProduit extends Model
{
    public function categorieProduit() {
        return $this->hasMany("App\CategorieProduit");
    }
}