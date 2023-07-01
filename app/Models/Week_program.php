<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week_program extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'day',
        'start_time',
        'end_time',
    ];
    public $timestamps = false ;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lecture()
    {
        return $this->hasOne(Lecture::class,'week_program_id');
    }
}
