<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $reques){
        $validateDta=$reques->validate([
            'title'=>'required',
            'author'=>'required',
            'genre_id'=>'required',
            'année_publication'=>'required',
            'ISBN'=>'required',
            'nombre_copies'=>'required',
        ]);

        Book::create($validateDta);
        return ['success','Book created successfully'];
    }

    public function show_all(Request $reques){
        $books=Book::paginate(10);
        return $books;
    } 

    public function show(Request $reques){
        $id=$reques->id;
        return Book::find($id);
    }

    public function update(Request $reques,$id){
        $book = Book::findOrFail($id);

        $validatedData = $reques->validate([
            'title' => 'nullable',
            'author' => 'nullable',
            'genre_id' => 'nullable|integer',
            'année_publication' => 'nullable|date',
            'ISBN' => 'nullable|integer',
            'nombre_copies' => 'nullable|integer',
        ]);
        $book->update($validatedData);
        return response()->json($book);
    }
    public function destroy($id){
        $book = Book::findOrFail($id);
        $book->delete();
        return [
            'success' => 'Book deleted successfully'
        ];
    }
}
