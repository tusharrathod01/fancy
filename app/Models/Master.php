<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at','created_at'];

    protected $fillable = [
        'priority',
        'name',
        'intensity',
        'overtone',
        'color',
        'p_from',
        'p_to',
        'date',
        'c_id',
        'm_c_id',
    ];
}
