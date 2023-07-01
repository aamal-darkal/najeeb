<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'time_publish'
    ];
    public $timestamps = false ;
    public function students()
    {
        return $this->belongsToMany(Student::class,'student_notifications')->withPivot(['seen']);
    }
}
