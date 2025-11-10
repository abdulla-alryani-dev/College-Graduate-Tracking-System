<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class UniversityData extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'full_name',
        'sex',
        'major',
        'GPA',
        'honours_degree',
        'graduation_year',
    ];

    protected function casts(): array
    {
        return [
            'honours_degree' => 'boolean',
            'graduation_year' => 'integer',
        ];
    }
    public function graduates()
    {
        return $this->hasOne(Graduate::class);
    }
}
