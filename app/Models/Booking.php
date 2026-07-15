<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'trip_id', 'seats', 'total_price', 'status', 'booked_at', 'cancelled_at', 'cancellation_reason'];

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
