<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    public function produit() {
        return $this->hasMany("App\Produit");
    }
}
