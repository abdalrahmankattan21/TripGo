<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Companion extends Model
{
    protected $fillable = ['name', 'national_id', 'birth_date',  'booking_id', 'waiting_list_id'];

    public function booking() : BelongsTo {
        return $this->belongsTo(Booking::class);
    }
    public function waitingList() : BelongsTo  {
        return $this->belongsTo(WaitingList::class);
    }
}
