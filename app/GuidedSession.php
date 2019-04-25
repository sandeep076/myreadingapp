<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidedSession extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sessionID', 'pupilID', 'teacherID', 'ISBN', 'notes', 'session_date', 
    ];
}
