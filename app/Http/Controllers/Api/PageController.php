<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LignePage;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = \App\Page::orderBy('id', 'DESC')->get();
        return $pages;
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
        //
        $page = new \App\Page();
        $page->nom = $request->nom;
        /*if(!is_null($request->icone)){
            //Upload
            $folder = "images/pages";
            $path = public_path($folder."/");
            $date = new \DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $filename = $date.$request->icone->getClientOriginalExtension();
            $request->icone->move($path, $filename);
            $page->icone = 'http://'.$_SERVER['HTTP_HOST'].'/'.$folder.'/'.$filename;
        }*/
        $page->icone = 'fa fa-image';
        $page->contenu = $request->contenu;
        $page->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = \App\Page::find($id);
        return $page;
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
        //
        $page = \App\Page::find($id);
        if($request->nom != ''){
            $page->nom = $request->nom;
        }
        $page->contenu = $request->contenu;
        /*if($request->file('icone')){
            //Upload
            $folder = "images/pages";
            $path = public_path($folder."/");
            $date = new \DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $filename = $date.$request->icone->getClientOriginalExtension();
            $request->icone->move($path, $filename);
            $page->icone = 'http://'.$_SERVER['HTTP_HOST'].'/'.$folder.'/'.$filename;
        }*/
        $page->icone = 'fa fa-image';
        $page->save();
        return $page;
    }

    public function ligne($id){
        $lignes = LignePage::where('page_id', $id)->orderBy('id', 'DESC')->get();
        return $lignes;
    }

    public function addligne(Request $request, $id){
        $ligne = new LignePage();
        $ligne->ligne = $request->ligne;
        $ligne->page_id = $id;
        $ligne->save();
        return $ligne;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $page = \App\Page::find($id)->delete();
        return "success";

    }
}
