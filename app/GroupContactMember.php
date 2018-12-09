<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupContactMember extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_contacts_id', 'contacts_id'
    ];

    /**
     * Get the company that owns the group message template.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
