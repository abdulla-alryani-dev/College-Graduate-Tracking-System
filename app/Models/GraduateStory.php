<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduateStory extends Model
{
    /** @use HasFactory<\Database\Factories\GraduateStoryFactory> */
    use HasFactory;


    protected $fillable = ['name', 'position', 'des', 'image', 'graduate_id'];

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }
}
