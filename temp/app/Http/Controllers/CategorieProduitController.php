<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use App\CategorieProduit;
use Illuminate\Support\Facades\DB;

class CategorieProduitController extends Controller
{
    public function categorie($id) {

        $key = DB::table('categorie_produits')->select('nom')->where('id', $id)->get();

        foreach ($key as $ky) {
            $search_q = $ky->nom;
        }
        
        return view('visitor.categorie', [
            'produits' => Produit::where('categorie_produit_id', $id)->get(),
            'search_q' => $search_q,
            'categories' => CategorieProduit::orderBy('nom')->get()
        ]);
    }
}
