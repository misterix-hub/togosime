<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategorieProduit;

class MessageController extends Controller
{
    public function index() {

        return view('visitor.message', [
            'categories' => CategorieProduit::orderBy('nom')->get()
        ]);
    }
}
