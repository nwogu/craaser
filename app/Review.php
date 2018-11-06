<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'review', 'rating',
    ];

    /**
     * Get the company that owns the review.
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
