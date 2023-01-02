<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    
        protected $fillable = [
        'cases_id',
        'c_date',
        'c_for',
        'n_date',
        'n_for',
        'remark',
    ];
}
