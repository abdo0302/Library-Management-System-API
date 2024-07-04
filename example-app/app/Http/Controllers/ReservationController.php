<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $reques){
        $validateDta=$reques->validate([
            'member_id'=>'required|integer',
            'book_id'=>'required|integer',
            'reserved_date'=>'required|date',
        ]);

        Reservation::create($validateDta);
        return ['success','Reservation created successfully'];
    }

    public function show_all(Request $reques){
        $reservations=Reservation::paginate(10);
        return $reservations;
    } 

    public function show(Request $reques){
        $id=$reques->id;
        return Reservation::find($id);
    }

    public function update(Request $reques,$id){
        $Reserv = Reservation::findOrFail($id);

        $validatedData = $reques->validate([
            'member_id'=>'nullable|integer',
            'book_id'=>'nullable|integer',
            'reserved_date'=>'nullable|date',
        ]);
        $Reserv->update($validatedData);
        return response()->json($Reserv);
    }
    public function destroy($id){
        $Reserv = Reservation::findOrFail($id);
        $Reserv->delete();
        return [
            'success' => 'genre deleted successfully'
        ];
    }
}
