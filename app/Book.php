<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bookID', 'title', 'author', 'bookBand', 'due',
    ];
}
