<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    public function gammeProduit() {
        return $this->belongsTo("App\GammeProduit");
    }

    public function produit() {
        return $this->hasMany("App\Produit");
    }
}
