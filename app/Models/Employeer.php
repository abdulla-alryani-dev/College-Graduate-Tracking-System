<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
        'industry',
    ];
    public function offers()
{
    return $this->hasMany(Offer::class);
}
    // Relationship with the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
