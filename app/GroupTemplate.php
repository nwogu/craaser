<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTemplate extends Model
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
     * Get the company that owns the group template.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

     /**
     * Get the messages of the group template.
     */
    public function messages()
    {
        return $this->belongsToMany('App\EmailTemplate', 'group_message_templates', 'group_templates_id', 'email_templates_id');
    }
    

}
