<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Get the users with this role.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
