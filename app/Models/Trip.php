<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['title', 'description', 'image', 'start_date', 'end_date', 'departure_point', 'booking_cancel_deadline', 'destination_id', 'category_id','total_seats', 'available_seats','price', 'status'];

    protected function casts(): array {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'booking_cancel_deadline' => 'datetime',
        ];
    }

    public function destination()
{
    return $this->belongsTo(Destination::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function bookings() {
    return $this->hasMany(Booking::class);
}
public function guides()
{
    return $this->belongsToMany(Guide::class, 'guide_trip', 'trip_id', 'guide_id');
}
}
