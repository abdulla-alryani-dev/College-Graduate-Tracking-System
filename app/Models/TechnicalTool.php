<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class TechnicalTool extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'category', 'description'];


    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_technical_tool')
            ->withPivot('proficiency_level', 'is_mandatory')
            ->withTimestamps();
    }

}
