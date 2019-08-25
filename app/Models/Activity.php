<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_date',
        'deadline', 'end_date', 'user_id',
        'status_id'
    ];

    public function status()
    {
        // return $this->hasOne('App\Models\Status', 'id', 'status_id');
        return $this->hasOne('App\Models\Status');
    }

    public function user()
    {
        // return $this->belongsTo('App\Models\User', 'id', 'user_id');
        return $this->belongsTo('App\Models\User');
    }
}
