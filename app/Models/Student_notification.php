<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_id',
        'issuing_date',
        'arrival_date',
        'state',
    ];
}
