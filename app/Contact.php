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
        'firstname', 'lastname', 'email', 'phone', 'address', 'status'
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

    /**
     * Get the group.
     */
    public function groups()
    {
        return $this->belongsToMany('App\GroupContact', 'group_contact_members', 'contacts_id', 'group_contacts_id');
    }
}
