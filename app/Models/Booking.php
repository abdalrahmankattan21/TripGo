<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = ['user_id', 'trip_id', 'seats', 'total_price', 'status', 'booked_at', 'cancelled_at', 'cancellation_reason'];

    protected function casts(): array {
        return [
            'booked_at' => 'datetime',
        ];
    }

    public function user() : BelongsTo  {
        return $this->belongsTo(User::class);
    }

    public function trip() : BelongsTo  {
        return $this->belongsTo(Trip::class);
    }

    public function companions() : HasMany {
        return $this->hasMany(Companion::class);
    }

    public function payment() : HasOne {
        return $this->hasOne(Payment::class);
    }
}
