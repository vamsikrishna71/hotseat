<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'department',
        'designation',
        'email',
        'password',
        // 'dob', 
        'logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        
    /**
     * location
     *
     * @return void
     */
    public function location(){
        return $this->hasMany(Location::class);
    }
        
    /**
     * employee
     *
     * @return void
     */
    public function employee(){
        return $this->hasMany(Employee::class);
    }
        
    /**
     * desk
     *
     * @return void
     */
    public function desk(){
        return $this->hasMany(Desk::class);
    }

    /**
     * desk
     *
     * @return void
     */
    public function deskAssignEmployee()
    {
        return $this->hasMany(DeskAssign::class);
    }
}
