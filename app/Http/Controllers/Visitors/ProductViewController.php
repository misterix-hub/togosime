<?php

namespace App\Http\Controllers\Visitors;
use App\Produit;
use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    //
    public function produitCategorie($id){
        $produits = Produit::where('categorie_id', $id)->get();
        return view('visitors.produit.produitCategorie', [
            'produits' => $produits,
            'categories' => Categorie::all(),
        ]);
    }
    public function produitRechercher($contenu) {
        $produits = Produit::where('nom', 'LIKE', "%{$contenu}%")->get();
        return view('visitors.produit.produitSearchResult', [
            'produits' => $produits,
            'categories' => Categorie::all(),
        ]);
    }
}
