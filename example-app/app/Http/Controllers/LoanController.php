<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    public function store(Request $reques){
        $validateDta=$reques->validate([
            'member_id'=>'required',
            'book_id'=>'required',
            'issued_date'=>'required',
            'due_date'=>'required',
            'returned_date'=>'required',
            'amende_jour'=>'required',
        ]);

        Loan::create($validateDta);

        $due_date=new \DateTime($validateDta['due_date']);
        $returned_date=new \DateTime($validateDta['returned_date']);

        $jour_retard= $due_date->diff($returned_date);
        $jour_retard->format("%a days");

        $prix=$jour_retard->m * $validateDta['amende_jour'];
        $retard=$jour_retard->m;

        if($due_date>$returned_date){
            $prix=0;
            $retard=0;
        }

        return [
            'success',
            'created Loan successfully',
             'les jours de retard => '.$retard.'jour',
             'le prix de retard => '.$prix .'DH',
            ];
    }

    public function show_all(){
        $Loan=Loan::paginate(10);
        return $Loan;
    } 

    public function show(Request $reques){
        $id=$reques->id;
        return Loan::find($id);
    }

    public function update(Request $reques,$id){
        $Loan = Loan::findOrFail($id);

        $validatedData = $reques->validate([
            'member_id'=>'nullable|integer',
            'book_id'=>'nullable|integer',
            'issued_date'=>'nullable|date',
            'due_date'=>'nullable|date',
            'returned_date'=>'nullable|date',
            'amende_jour'=>'nullable|integer',
        ]);
        $Loan->update($validatedData);
        
        $due_date=new \DateTime($validatedData['due_date']);
        $returned_date=new \DateTime($validatedData['returned_date']);

        $jour_retard= $due_date->diff($returned_date);
        $jour_retard->format("%a days");

        $prix=$jour_retard->m * $validatedData['amende_jour'];
        $retard=$jour_retard->m;

        if($due_date>$returned_date){
            $prix=0;
            $retard=0;
        }

        return [
            'success',
            'modifier Loan successfully',
             'les jours de retard => '.$retard.'jour',
             'le prix de retard => '.$prix .'DH',
            ];
    
    }
    public function destroy($id){
        $Loan = Loan::findOrFail($id);
        $Loan->delete();
        return [
            'success' => 'Loan deleted successfully'
        ];
    }
}
