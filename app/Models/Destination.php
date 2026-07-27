<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function scopeSearch($query, ?string $search)
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where('name', 'like', "%{$search}%");

    }
}
