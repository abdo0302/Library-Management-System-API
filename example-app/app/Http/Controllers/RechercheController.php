<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class RechercheController extends Controller
{
    public function recherche(Request $request){
        $title=$request->title;
        $book=Book::where('title','like','%'.$title.'%')->get();
        return $book;
    }
}
