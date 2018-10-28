<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'interval_day', 'is_active'
    ];

     /**
     * Get the company of the campaign.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

     /**
     * Get the contact status of the campaign.
     */
    public function contactStatus()
    {
        return $this->belongsTo('App\Status');
    }

    /**
     * Get the sms template of the campaign.
     */
    public function smsTemplate()
    {
        return $this->belongsTo('App\SmsTemplate');
    }

    /**
     * Get the email template of the campaign.
     */
    public function emailTemplate()
    {
        return $this->belongsTo('App\EmailTemplate');
    }
}
