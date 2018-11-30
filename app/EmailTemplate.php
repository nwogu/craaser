<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body', 'subject'
    ];

    /**
     * Get the company that owns the email template.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * Get the company that owns the email template.
     */
    public function groups()
    {
        return $this->belongsToMany('App\GroupTemplate', 'group_message_templates', 'email_templates_id', 'group_templates_id');
    }
}
