<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'start_date',
        'zoo_id'
    ];

    function zoo()
    {
        return $this->belongsTo(Zoo::class);
    }
}
