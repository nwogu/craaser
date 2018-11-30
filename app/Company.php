<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'slug', 'phone', 'logo', 'address'
    ];

     /**
     * Get the users of the company.
     */
    public function users()
    {
        return $this->hasMany('App\User')->orderBy('created_at', 'desc');
    }

     /**
     * Get the reviews of the company.
     */
    public function reviews()
    {
        return $this->hasMany('App\Review')->orderBy('created_at', 'desc');
    }

    /**
     * Get the contacts of the company.
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact')->orderBy('created_at', 'desc');
    }

     /**
     * Get the sms templates of the company.
     */
    public function smsTemplates()
    {
        return $this->hasMany('App\SmsTemplate')->orderBy('created_at', 'desc');
    }

     /**
     * Get the email templates of the company.
     */
    public function emailTemplates()
    {
        return $this->hasMany('App\EmailTemplate')->orderBy('created_at', 'desc');
    }

     /**
     * Get the campaigns of the company.
     */
    public function campaigns()
    {
        return $this->hasMany('App\Campaign')->orderBy('created_at', 'desc');
    }

     /**
     * Get the group templates of the company.
     */
    public function groupTemplates()
    {
        return $this->hasMany('App\GroupTemplate')->orderBy('created_at', 'desc');
    }

     /**
     * Get the group templates of the company.
     */
    public function groupMessageTemplates()
    {
        return $this->hasMany('App\GroupMessageTemplate')->orderBy('created_at', 'desc');
    }
}
