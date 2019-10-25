<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use App\Partenaire;
use App\CategorieProduit;
use App\Commande;

class ProduitController extends Controller
{
    public function rechercher(Request $request) {

        return view('visitor.produit.search', [
            'produits' => Produit::where('nom', 'like', '%'.$request->search_q.'%')->get(),
            'search_q' => $request->search_q,
            'categories' => CategorieProduit::orderBy('nom')->get()
        ]);
    }

    public function details($id) {

        return view('visitor.produit.details', [
            "produits" => Produit::where('id', $id)->get(),
            "partenaires" => Partenaire::where('fournisseur', 'on')->get(),
            "categories" => CategorieProduit::all()
        ]);
    }

    public function commander($id) {

        return view('visitor.produit.commander', [
            "produits" => Produit::where('id', $id)->get(),
            'categories' => CategorieProduit::orderBy('nom')->get()
        ]);
    }

    public function commanderProccessing(Request $request, $id) {

        $check_commande = Commande::where('contact', $request->contact)
                                    ->where('produit_id', $id)
                                    ->where('validated', null)
                                    ->get();

        if(count($check_commande) != 0) {
            return back()->with('message', "Ce contact a déjà fait object de cette commande !");
        } else {
            $commade = new Commande;
            $commade->produit_id = $id;
            $commade->contact = $request->contact;
    
            $commade->save();
    
            return redirect(route('indexVisitor'))->with('message', "Votre commande a été bel et bien enregisté. vous recevrez un appel bientôt !");
        }

    }
}