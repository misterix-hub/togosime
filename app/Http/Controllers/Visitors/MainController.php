<?php

namespace App\Http\Controllers\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;

class MainController extends Controller
{
    public function index() {
        return view('visitors.index', [
            'categories' => Categorie::all(),
            'i' => 0
        ]);
    }
}
