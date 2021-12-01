<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zipcode',
        'timezone',
        'state',
        'city',
        'country',
        'address'
    ];
    
    /**
     * Relationship attributes
     *
     * @return void
     */
    public function zone()
    {
        return $this->hasMany(Zone::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,
            'user_id',
            'id');
    }
 
}
