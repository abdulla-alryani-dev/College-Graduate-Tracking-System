<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'compony',
        'location',
        'field_of_work',
        'technology',
        'created_at',
        'updated_at',
    ];
    public function graduates()
    {
        return $this->belongsToMany(Graduate::class, 'job_graduate')
            ->withPivot(['start_date', 'end_date'])
            ->withTimestamps();
    }

}
