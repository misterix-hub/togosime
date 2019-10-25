<?php

namespace App\Http\Controllers\Api;

use App\CategorieProduit;
use App\Http\Controllers\Controller;
use App\Produit;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\CategorieProduit::orderBy('id', 'DESC')->with('gammeProduit')->get();
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
        // $this->validate($request, [
        //     'gamme_produit_id' => 'required|int',
        //     'nom' => 'required|unique:categorie_produits,nom',
        //     'description' => 'required'
        // ]);

        $categorie = new \App\CategorieProduit;
        $categorie->gamme_produit_id = $request->gamme_produit_id;
        $categorie->nom = $request->nom;
        $categorie->description = $request->description;

        $categorie->save();

        return $categorie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = CategorieProduit::findOrFail($id)->with('gammeProduit')->first();
        return $details;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'gamme_produit_id' => 'required|int',
            'nom' => 'required',
            'description' => 'required'
        ]);

        $categorie = \App\CategorieProduit::findOrFail($id);

        $categorie->gamme_produit_id = $request->gamme_produit_id;
        $categorie->nom = $request->nom;
        $categorie->description = $request->description;

        $categorie->save();

        return $categorie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categorie = \App\CategorieProduit::findOrFail($id);

        $categorie->delete();

        return ['message' => 'Catégorie supprimée avec succès !'];
    }
}
