<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Report extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'reports';
    
    protected $fillable = [
        'summary', 'high', 'low', 'comments', 'zip', 'user'
    ];

    
}
