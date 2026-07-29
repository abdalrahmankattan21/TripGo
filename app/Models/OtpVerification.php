<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OtpVerification extends Model
{
    protected $fillable = [
        'user_id',
        'otp_code',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
