<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body'
    ];

    /**
     * Get the company that owns the sms template.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
