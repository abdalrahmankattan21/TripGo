<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['title', 'description', 'image', 'price', 'start_date', 'total_seats', 'available_seats', 'departure_points', 'status', 'destination_id', 'category_id'];

    public function destination()
{
    return $this->belongsTo(Destination::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
}
