<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produit;
use App\CategorieProduit;
use App\GammeProduit;
use App\Partenaire;
use App\Commande;
class StatistiqueController extends Controller
{
    //
        //Admin
        public function generalCount(){

            $totalProduit = Produit::count();
            $totalCategorieProduit = CategorieProduit::count();
            $totalCommande = Commande::count();
            $totalGammeProduit = GammeProduit::count();
            $totalPartenaire = Partenaire::where('fournisseur', false)->count();
            $totalFournisseur = Partenaire::where('fournisseur', true)->count();
            $totalCommandeAttente = Commande::where('validated', false)->count();
            $totalCommandeValide = Commande::where('validated', true)->count();

            $pGC = array(
                    'total_produit'=>$totalProduit,
                    'total_gamme_produit'=>$totalGammeProduit,
                    'total_categorie_produit'=>$totalCategorieProduit,
                    'total_commande'=>$totalCommande,
                    'total_partenaire'=>$totalPartenaire,
                    'total_fournisseur'=>$totalFournisseur,
                    'total_commande_attente'=>$totalCommandeAttente,
                    'total_commande_valide'=>$totalCommandeValide,
                );

            return response()->json($pGC);

        }

        public function nombreDeCategorieCommande(){

            $result = \DB::table('commandes')
                ->select('categorie_produits.id', 'categorie_produits.nom', \DB::raw("count(commandes.id) as 'nombre'" ))
                ->join('produits', 'commandes.produit_id', '=', 'produits.id')
                ->join('categorie_produits', 'produits.categorie_produit_id', '=', 'categorie_produits.id')
                ->where('commandes.validated', true)
                ->groupBy('categorie_produits.nom', 'categorie_produits.id')
                ->get()
            ;
            $total = \App\Commande::where('validated', true)->count();
            //$total = $total['total'];
            return response()->json($result);

        }
        public function nombreDeGammeCommande(){

            $result = \DB::table('commandes')
                ->select('gamme_produits.id', 'gamme_produits.nom', \DB::raw("count(commandes.id) as 'nombre'" ))
                ->join('produits', 'commandes.produit_id', '=', 'produits.id')
                ->join('categorie_produits', 'produits.categorie_produit_id', '=', 'categorie_produits.id')
                ->join('gamme_produits', 'categorie_produits.gamme_produit_id', '=', 'gamme_produits.id')
                ->where('commandes.validated', true)
                ->groupBy('gamme_produits.nom', 'gamme_produits.id')
                ->get()
            ;
            $total = \App\Commande::where('validated', true)->count();
            //$total = $total['total'];
            return response()->json($result);

        }
}
