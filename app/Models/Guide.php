<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone','bio'];

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function scopeSearch($query, $search)
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where('name', 'like', "%{$search}%");

    }
}
