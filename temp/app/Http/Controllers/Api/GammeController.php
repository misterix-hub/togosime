<?php

namespace App\Http\Controllers\Api;

use App\GammeProduit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\GammeProduit::orderBy('id', 'DESC')->get();
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
        $this->validate($request, [
            'nom' => 'required|unique:gamme_produits,nom',
            'description' => 'required'
        ]);

        $gamme = new \App\GammeProduit;

        $gamme->nom = $request->nom;
        $gamme->description = $request->description;

        $gamme->save();

        return $gamme;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = \App\GammeProduit::findOrFail($id);

        return [
            "nom" => $details->nom,
            "description" => $details->description,
            "categories" => GammeProduit::findOrFail($id)->categorieProduit
        ];
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
            'nom' => 'required',
            'description' => 'required'
        ]);

        $gamme = \App\GammeProduit::findOrFail($id);

        $gamme->nom = $request->nom;
        $gamme->description = $request->description;

        $gamme->save();

        return $gamme;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gamme = \App\GammeProduit::findOrFail($id);

        $gamme->delete();

        return $gamme;
    }
}
