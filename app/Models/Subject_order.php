<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'subject_id',
        'cost',
    ];
}
