<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public function categorieProduit() {
        return $this->belongsTo("App\CategorieProduit");
    }

    public function partenaire() {
        return $this->belongsTo("App\Partenaire");
    }
    public function commandes() {
        return $this->hasMany("App\Commande");
    }
}
