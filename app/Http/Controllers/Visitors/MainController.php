<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;
use App\Produit;
use App\Annonce;

class MainController extends Controller
{
    public function index() {
        return view('visitors.index', [
            'categories' => Categorie::all(),
            'produits' => Produit::paginate(6),
            'annonces' => Annonce::all(),
            'i' => 0
        ]);
    }
}
