<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'school',
        'duration',
    ];
    public function graduates()
{
    return $this->belongsToMany(Graduate::class, 'course_graduate');
}

}
