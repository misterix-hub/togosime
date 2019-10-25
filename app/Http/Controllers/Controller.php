<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\CategorieProduit;
use App\Produit;
use App\Partenaire;
use App\Video;
use App\Page;
use App\Image;
use App\LignePage;
use App\Parametre;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('admin.index', [
            
        ]);
    }

    public function indexVisitor() {

        return view('visitor.index', [
            'i' => 0,
            'categories' => CategorieProduit::orderBy('nom')->get(),
            'carousels' => Produit::limit(5)->get(),
            'produits' => Produit::paginate(8),
            'partenaires' => Partenaire::where('fournisseur', 1)->get(),
            'videos' => Video::limit(1)->get(),
            'pages' => Page::all(),
            'ligne_pages' => LignePage::all(),
            'images' => Image::all(),
            'parametres' => Parametre::all()
        ]);
    }

    public function page($id) {

        return view('visitor.page', [
            'categories' => CategorieProduit::orderBy('nom')->get(),
            'pages' => Page::where('id', $id)->get(),
            'ligne_pages' => LignePage::all()
        ]);
    }
}
