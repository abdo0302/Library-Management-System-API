<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'book_id',
        'issued_date',
        'due_date',
        'returned_date',
        'amende_jour'
    ];
}
