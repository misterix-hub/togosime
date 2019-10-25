<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commande;

class CommandeController extends Controller
{
    //
    public function uVList(){
        $commandes = Commande::where('validated', false)->orderBy('id', 'DESC')->with('produit')->get();
        return $commandes;
    }
    public function vList(){
        $commandes = Commande::where('validated', true)->orderBy('id', 'DESC')->with('produit')->get();
        return $commandes;
    }

    public function validateCommande($id){
        $commande = Commande::find($id);
        $commande->validated = true;
        $commande->save();
        return $commande;
    }
    public function delete($id){
        $commande = Commande::find($id);
        $commande->delete();
        return $commande;
    }
}
