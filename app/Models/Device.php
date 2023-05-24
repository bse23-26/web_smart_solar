<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_uuid',
        'description',
        'location',
        'user_id',
        'last_seen'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_seen' => 'datetime',
    ];
}
