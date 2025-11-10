<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'active',
        'description',
        'room', //cs-2025-f or is-2024-m
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

}
