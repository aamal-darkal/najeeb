<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pdf_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecture_id',
        'pdf_link',
        'name'
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
