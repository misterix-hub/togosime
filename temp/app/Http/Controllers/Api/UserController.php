<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = \App\User::orderBy('id', 'DESC')->get();

        return response()->json($users);
    }

    public function userAdmin()
    {
        //

        $users = \App\User::where('type', 'ADMIN')->orderBy('id', 'DESC')->get();

        return response()->json($users);
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
        $user = new \App\User();
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);

        $folder = "profilePhotos";
        $user->photo = $folder.'/'.'profile.jpg';

        $user->save();

        $user = \App\User::find($user->id);

        return response()->json($user);

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
        $user = \App\User::find($id);
        //$user = \App\User::find($id);
        return response()->json($user);

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
        //$user = \App\User::find($id);
        $user = \App\User::find($id);



        if($request->email){
            $user->email = $request->email;
        }

        if($request->first_name){
            $user->first_name = $request->first_name;
        }

        if($request->last_name){
            $user->last_name = $request->last_name;
        }

        if($request->description){
            $user->description = $request->description;
        }



        if(isset($request->type)){
            $user->type = $request->type;
        }





        //$user->deleted=false;

        $user->save();

        return response()->json($user);

    }

    public function updatePhoto(Request $request, $id){

        $user = \App\User::find($id);

        if(!is_null($request->photo)){
            //Upload
            /*$folder = "profilePhotos";
            $path = public_path($folder."/");
            $date = new \DateTime('NOW');
            $date = $date->format('Y-m-d H:i:s');
            $filename = $id.".".$date.$request->photo->getClientOriginalExtension();
            $request->photo->move($path, $filename);
            $user->photo = $folder.'/'.$filename;
            $user->save();*/

            $target_dir = "profilePhotos/";

            $target_file = $target_dir . time() . "_" . basename($_FILES["photo"]["name"]);
            $FileType = strtolower(pathinfo(basename($_FILES["photo"]["name"]), PATHINFO_EXTENSION));

            if($FileType != "jpg" && $FileType != "jpeg" && $FileType != "png") {
                return [
                    "message" => "Type de fichier non pris en charge !"
                ];

            } elseif(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $user->photo = 'http://'.$_SERVER['HTTP_HOST'].'/'.$target_file;
            }

        }

        $user->save();

        return response()->json($user->photo);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = \App\User::find($id);

        $user->delete();

        return ['message'=>'success'];

    }

    public function exists(Request $request){

        try{
            $user = \App\User::where('username', $request->username);
            //return response()->json(array('exists'=>$request->username));
            return response()->json(array('exists'=>$user->username));

            if(isset($user->username)){
                return response()->json(array('exists'=>true));

            }else{
                return response()->json(array('exists'=>false));

            }

        }catch(Exception $e){
            return response()->json(array('exists'=>false));
        }


    }
}
