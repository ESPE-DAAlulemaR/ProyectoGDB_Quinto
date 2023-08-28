<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'zoo_id'
    ];

    public function zoo()
    {
        return $this->belongsTo(Zoo::class);
    }

    public static function getItineraries($zooNumericCode)
    {
        $table = 'itineraries_partitions_' . $zooNumericCode;

        return DB::table($table)
            ->select($table.'.id', 'guides.name AS guide', 'zones.name AS zone', $table.'.duration', $table.'.max_visitors', $table.'.start_time', $table.'.zoo_id')
            ->join('guides', 'guides.id', '=', $table.'.guide_id')
            ->join('zones', 'zones.id', '=', $table.'.zone_id')
        ->get();
    }

    public static function getItinerary($zooNumericCode, $id)
    {
        $table = 'itineraries_partitions_' . $zooNumericCode;

        return DB::table($table)
            ->select($table.'.*', 'guides.name AS guide', 'zones.name AS zone')
            ->join('guides', 'guides.id', '=', $table.'.guide_id')
            ->join('zones', 'zones.id', '=', $table.'.zone_id')
            ->where($table.'.id', $id)
        ->first();
    }

    public static function updateItinerary($zooNumericCode, $values)
    {
        $table = 'itineraries_partitions_' . $zooNumericCode;
        $n = count($values);
        $counter = 0;

        $query = 'UPDATE '. $table .' SET ';

        foreach ($values as $key => $value) {
            $query .= $key ." = '". $value."'";
            $counter++;

            if ($counter != $n)
                $query .= ', ';
            else
                $query .= ' ';
        }

        $query .= 'WHERE id = ?';

        return DB::update($query, [ $values['id'] ]);
    }

    public static function deleteItinerary($zooNumericCode, $id)
    {
        $table = 'itineraries_partitions_' . $zooNumericCode;

        return DB::delete('DELETE FROM '. $table .' WHERE id = ?', [ $id ]);
    }
}
