<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'building_name',
        'level',
        'location_id',
        'zone',
    ];

    /**
     * Relationship of the zone with the given attributes.
     *
     * @return void
     */
    public function location()
    {
        return $this->belongsTo(
            Location::class,
            'location_id',
            'id'
        );
        
    }
}
