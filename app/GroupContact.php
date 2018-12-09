<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupContact extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

     /**
     * Get the company that owns the group.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

     /**
     * Get the contacts of the group.
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contact', 'group_contact_members', 'group_contacts_id', 'contacts_id');
    }
}
