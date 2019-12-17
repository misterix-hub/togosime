<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;
use App\Produit;

class MainController extends Controller
{
    public function index() {
        return view('visitors.index', [
            'categories' => Categorie::all(),
            'produits' => Produit::paginate(6),
            'i' => 0
        ]);
    }
}
