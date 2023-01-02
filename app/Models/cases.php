<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cases extends Model
{
    use HasFactory;

    protected $fillable = [
        'num',
        'year',
        'caseno',
        'filing_date',
        'n_date',
        'n_for',
        'status',
        'final_result',
        'date_final_result',
        'pdf',
    ];


}
