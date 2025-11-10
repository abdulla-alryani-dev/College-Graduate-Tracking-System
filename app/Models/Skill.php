<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'technology',
        'accomplishment',
        'graduate_id',
    ];

    public function graduate(): BelongsTo
    {
        return $this->belongsTo(Graduate::class);
    }
    public function graduates()
{
    return $this->belongsToMany(Graduate::class, 'skill_graduate');
}

}
