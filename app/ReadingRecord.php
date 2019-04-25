<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadingRecord extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recordID', 'ISBN', 'title', 'author', 'bookBand', 'due', 'commentDate', 'comment', 
    ];
}
