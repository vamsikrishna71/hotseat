<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskAssign extends Model
{
    use HasFactory;
    protected $fillable = ['desk_name', 'employee_name','latitude', 'longitude'];


    /**
     * Desk
     *
     * @return void
     */
    public function desk()
    {
        return $this->belongsTo(
            Desk::class,
            'desk_id',
            'id'
        );
    }
}
