<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Partenaire::orderBy('id', 'DESC')->get();
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
        //     'nom' => 'required|unique:partenaires,nom',
        //     'logo' => 'required'
        // ]);
        $partenaire = new Partenaire;
        if($request->nom != ''){
            $partenaire->nom = $request->nom;
        }
        if($request->description != ''){
            $partenaire->description = $request->description;
        }
        // return $request->fournisseur;
        // $partenaire->fournisseur = $request->fournisseur;
        if($request->fournisseur != ''){
            if($request->fournisseur == 'true'){
                $partenaire->fournisseur = 1;
            } else {
                $partenaire->fournisseur = 0;
            }

        }

        if(!empty($_FILES["logo"]["name"])) {
            $target_dir = "images/partenaires/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["logo"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {

                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $partenaire->logo = 'http://'.$_SERVER['HTTP_HOST'].'/'.$target_file;
            }
        }
        if($request->telephone != ''){
            $partenaire->telephone = $request->telephone;
        }
        if($request->adresse != ''){
            $partenaire->adresse = $request->adresse;
        }
        if($request->site_web != ''){
            $partenaire->site_web = $request->site_web;
        }

        $partenaire->save();

        return [
            "message" => "Partenaire modifié(e) avec succès !",
            "partenaire" => $partenaire
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Partenaire::findOrFail($id);
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

        $partenaire = Partenaire::findOrFail($id);
        if($request->nom != ''){
            $partenaire->nom = $request->nom;
        }
        if($request->description != ''){
            $partenaire->description = $request->description;
        }
        if(!empty($_FILES["logo"]["name"])) {
            $target_dir = "images/partenaires/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["logo"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {

                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $partenaire->logo = 'http://'.$_SERVER['HTTP_HOST'].'/'.$target_file;
            }
        }
        if($request->telephone != ''){
            $partenaire->telephone = $request->telephone;
        }
        if($request->adresse != ''){
            $partenaire->adresse = $request->adresse;
        }
        if($request->site_web != ''){
            $partenaire->site_web = $request->site_web;
        }

        $partenaire->save();

        return [
            "message" => "Partenaire modifié(e) avec succès !",
            "partenaire" => $partenaire
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $partenaire->delete();

        return [
            "message" => "Partenaire supprimé(e) avec succès !"
        ];
    }
}
