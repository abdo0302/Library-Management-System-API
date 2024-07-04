<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\genre;

class genreController extends Controller
{
    public function store(Request $reques){
        $validateDta=$reques->validate([
            'name'=>'required'
        ]);

        genre::create($validateDta);
        return ['success','genre created successfully'];
    }

    public function show_all(Request $reques){
        return genre::all();
    } 

    public function show(Request $reques){
        $id=$reques->id;
        return genre::find($id);
    }

    public function update(Request $reques,$id){
        $member = genre::findOrFail($id);

        $validatedData = $reques->validate([
            'name'=>'required',
        ]);
        $member->update($validatedData);
        return response()->json($member);
    }
    public function destroy($id){
        $book = genre::findOrFail($id);
        $book->delete();
        return [
            'success' => 'genre deleted successfully'
        ];
    }
}
