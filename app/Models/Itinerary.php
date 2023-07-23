<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'guide_id',
        'zone_id',
        'duration',
        'max_visitors',
        'start_time',
    ];
}
