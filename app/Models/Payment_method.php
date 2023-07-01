<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function payment()
    {
        $this->hasMany(Payment::class);
    }
}
