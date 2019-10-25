<?php

namespace App\Http\Controllers\Api;

use App\CategorieProduit;
use App\Http\Controllers\Controller;
use App\Partenaire;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Produit::orderBy('id', 'DESC')->with('categorieProduit')->get();
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
        //     'categorie_produit_id' => 'required|int',
        //     'partenaire_id' => 'required|int',
        //     'image' => 'required',
        //     'nom' => 'required',
        //     'prix' => 'required|int',
        //     'description' => 'required'
        // ]);


        $produit = new \App\Produit();

        $produit->categorie_produit_id = $request->categorie_produit_id;
        $produit->partenaire_id = $request->partenaire_id;
        $produit->nom = $request->nom;
        $produit->prix = $request->prix;
        $produit->description = $request->description;
        if(!is_null($request->image)){
            //Upload
            /*$folder = "images/produits";
            $path = public_path($folder."/");
            $date = new \DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $filename = $date.'.'.$request->image->getClientOriginalExtension();
            $request->image->move($path, $filename);
            $produit->image = 'http://'.$_SERVER['HTTP_HOST'].'/'.$folder.'/'.$filename;*/

            $target_dir = "images/produits/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {
                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $produit->image = 'http://'.$_SERVER['HTTP_HOST'].'/togosime/'.$target_file;
            }
        }

        $produit->save();
        return $produit;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit = Produit::find($id);

        return $produit;
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
        // $this->validate($request, [
        //     'categorie_produit_id' => 'required|int',
        //     'partenaire_id' => 'required|int',
        //     'image' => 'required',
        //     'nom' => 'required',
        //     'prix' => 'required|int',
        //     'description' => 'required'
        // ]);



        $produit = Produit::findOrFail($id);
        if($request->categorie_produit_id != ''){
            $produit->categorie_produit_id = $request->categorie_produit_id;
        }
        if($request->partenaire_id != ''){
            $produit->partenaire_id = $request->partenaire_id;
        }

        if($request->nom != ''){
            $produit->nom = $request->nom;
        }
        if($request->file('image')){
            $target_dir = "images/produits/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {
                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $produit->image = 'http://'.$_SERVER['HTTP_HOST'].'/togosime/'.$target_file;
            }
        }
        if($request->prix != ''){
            $produit->prix = $request->prix;
        }
        if($request->description != ''){
            $produit->description = $request->description;
        }

        $produit->save();
        $produit = Produit::with('categorieProduit')->find($id);
        return $produit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);

        $produit->delete();

        return [
            "message" => "Produit suppimé avec succès !"
        ];
    }
}
