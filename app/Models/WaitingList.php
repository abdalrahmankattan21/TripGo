<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaitingList extends Model
{
     use HasFactory;
        protected $fillable = ['user_id', 'trip_id', 'position',  'seats_requested', 'status', 'notified_at', 'expires_at'];

    public function user() : BelongsTo  {
        return $this->belongsTo(User::class);
    }

    public function trip() : BelongsTo  {
        return $this->belongsTo(Trip::class);
    }

     public function companions() : HasMany {
        return $this->hasMany(Companion::class);
    }
}
