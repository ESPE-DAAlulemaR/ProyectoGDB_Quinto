<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'caregiver_id',
        'zone_id',
        'habitat_id',
        'name',
        'scientific_name',
        'gender',
        'prueba',
        'zoo_id'
    ];

    function zoo()
    {
        return $this->belongsTo(Zoo::class);
    }
}
