<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Image::orderBy('id', 'DESC')->with('categorieImage')->get();
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
        //     'categorie_image_id' => 'required|int',
        //     'partenaire_id' => 'required|int',
        //     'image' => 'required',
        //     'titre' => 'required',
        //     'prix' => 'required|int',
        //     'description' => 'required'
        // ]);


        $image = new \App\Image();

        $image->categorie_image_id = $request->categorie_image_id;
        $image->titre = $request->titre;
        $image->description = $request->description;
        if($request->file('image')){
            
            //Upload
            /*$folder = "images/images";
            $path = public_path($folder."/");
            $date = new \DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $filename = $date.'.'.$request->image->getClientOriginalExtension();
            $request->image->move($path, $filename);
            $image->url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$folder.'/'.$filename;*/

            $target_dir = "images/images/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {
                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image->url = 'http://'.$_SERVER['HTTP_HOST'].'/togosime/'.$target_file;
            }
        }
        $image->save();
        return $image;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        return $image;
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
        //     'categorie_image_id' => 'required|int',
        //     'partenaire_id' => 'required|int',
        //     'image' => 'required',
        //     'titre' => 'required',
        //     'prix' => 'required|int',
        //     'description' => 'required'
        // ]);



        $image = Image::findOrFail($id);
        if($request->categorie_image_id != ''){
            $image->categorie_image_id = $request->categorie_image_id;
        }
        if($request->partenaire_id != ''){
            $image->partenaire_id = $request->partenaire_id;
        }

        if($request->titre != ''){
            $image->titre = $request->titre;
        }
        if($request->file('image')){

            $target_dir = "images/images/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {
                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image->url = 'http://'.$_SERVER['HTTP_HOST'].'/togosime/'.$target_file;
            }
        }
        
        if($request->description != ''){
            $image->description = $request->description;
        }

        $image->save();

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $image->delete();

        return [
            "message" => "Produit suppimé avec succès !"
        ];
    }
}
