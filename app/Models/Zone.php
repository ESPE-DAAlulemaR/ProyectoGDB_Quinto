<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'extension',
        'zoo_id'
    ];

    function zoo()
    {
        return $this->belongsTo(Zoo::class);
    }
}
