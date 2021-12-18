<?php

namespace App\Models;


// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Employee extends Authenticatable
{
    use HasFactory;
    
    protected $guard = 'employee';
    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['username','first_name','last_name','designation','department','password'];
    
    public function user(){
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
