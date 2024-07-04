<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;

class MemberController extends Controller
{
    public function store(Request $reques){
        $validateDta=$reques->validate([
            'name'=>'required',
            'email'=>'required|email',
            'date_dadhesion'=>'required',
            'status'=>'required',
        ]);

        member::create($validateDta);
        return ['success','member created successfully'];
    }

    public function show_all(Request $reques){
        $members=member::paginate(10);
        return $members;
    } 

    public function show(Request $reques){
        $id=$reques->id;
        return member::find($id);
    }

    public function update(Request $reques,$id){
        $member = member::findOrFail($id);

        $validatedData = $reques->validate([
            'name'=>'nullable',
            'email'=>'nullable|email',
            'date_dadhesion'=>'nullable',
            'status'=>'nullable',
        ]);
        $member->update($validatedData);
        return response()->json($member);
    }
    public function destroy($id){
        $book = member::findOrFail($id);
        $book->delete();
        return [
            'success' => 'member deleted successfully'
        ];
    }
}

