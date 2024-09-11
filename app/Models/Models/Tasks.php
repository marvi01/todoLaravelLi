<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'initialDate',
        'expectedFinalDate',
        'finalDate',
        'status',
    ];
}
