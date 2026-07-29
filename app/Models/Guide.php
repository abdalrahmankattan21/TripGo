<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'languages',
        'status',
    ];
    protected $casts = [
        'languages' => 'array',
    ];

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'guide_trip', 'guide_id', 'trip_id');
    }
}
