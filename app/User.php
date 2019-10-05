<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $fillable = [
        'id', 'visiting_controller', 'last_login', 'usergroup'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * Link to handover data
     * 
     * @return \App\Handover
     */
    public function handover(){
        return $this->hasOne(Handover::class, 'id');
    }

    /**
     * Link user's endorsement
     * 
     * @return \App\Endorsement
     */
    public function endorsement(){
        return $this->hasOne(Endorsement::class);
    }
}