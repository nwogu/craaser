<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
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
     * Get the contacts with this status.
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
