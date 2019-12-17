<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produit;
use App\Categorie;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produit.liste', [
            'produits' => Produit::all(),
            'categories' => Categorie::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->categorie == "") {
            return redirect(route('indexAdmin'))->with('error', "Vous devez sélectionner une catégorie !");
        }

        if (($_FILES['image']['name']!="")){
        
            $target_dir = "db/produits/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = $path['extension'];

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $produit = new Produit;
                    $produit->categorie_id = $request->categorie;
                    $produit->prix = $request->prix;
                    $produit->nom = $request->nom;
                    $produit->description = $request->description;
                    $produit->image = $path_filename_ext;
                    $produit->save();

                    return redirect(route('indexAdmin'))->with('success', 'Annonce ajoutée avec succèss !');
                } else {
                    return redirect(route('indexAdmin'))->with('error', 'Erreur de source iconnue. Réessayez !');
                }
            } else {
                return redirect(route('indexAdmin'))->with('error', 'Type de fichier non supporté !');
            }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort('404');
        }

        return view('admin.produit.supprimer', [
            'id' => $id,
            'categories' => Categorie::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort("404");
        }
        return view('admin.produit.details', [
            'id' => $id,
            'produits' => Produit::where('id', $id)->get(),
            'categories' => Categorie::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->nom = $request->nom;
        $produit->categorie_id = $request->categorie;
        $produit->prix = $request->prix;
        $produit->description = $request->description;

        if (($_FILES['image']['name']!="")){
        
            $target_dir = "db/produits/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = time();
            $ext = $path['extension'];

            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $temp_name = $_FILES['image']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                if (move_uploaded_file($temp_name,$path_filename_ext)) {

                    $produit->image = $path_filename_ext;
                    
                } else {
                    return redirect(route('indexAdmin'))->with('error', 'Erreur de source iconnue. Réessayez !');
                }
            } else {
                return redirect(route('indexAdmin'))->with('error', 'Type de fichier non supporté !');
            }
        }
        
        $produit->save();
        return redirect(route('detailsProduit', $id))->with('success', 'Produit à jour avec succèss !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Produit::where('id', $id)->get()) == 0) {
            abort('404');
        }
        
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect(route('listeProduit'))->with('success', "Le produit a été supprimé avec succès !");
    }
}
