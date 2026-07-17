<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $fillable = ["amount", "booking_id"];

    public function booking() : HasOne {
        return $this->hasOne(Booking::class);
    }
}
