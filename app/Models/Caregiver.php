<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'start_date',
        'zoo_id'
    ];

    function zoo()
    {
        return $this->belongsTo(Zoo::class);
    }
}
