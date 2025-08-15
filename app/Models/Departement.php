<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departements';

    protected $fillable = [
        'departement_name',
        'max_clock_in_time',
        'max_clock_out_time',
    ];
}
