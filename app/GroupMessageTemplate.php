<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessageTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_templates_id', 'email_templates_id'
    ];

    /**
     * Get the company that owns the group message template.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
