<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address',
    ];

    /**
     * Get the company that owns the contact.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

     /**
     * Get the status of the contact.
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
