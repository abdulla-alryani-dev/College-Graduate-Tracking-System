<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Offer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employeer_id', 'job_title', 'job_description', 'location', 'job_type', 'experience_level', 'expiration_date',
        'job_category', 'location_type', 'vacancies', 'salary_type', 'fixed_salary', 'fixed_salary_currency',
        'fixed_salary_period', 'salary_min', 'salary_max', 'salary_range_currency', 'salary_range_period', 'qualifications',
        'application_instructions', 'additional_info', 'is_active'
    ];






    public function employeer()  // Must match exactly - with two 'e's
    {
        return $this->belongsTo(Employeer::class, 'employeer_id');
        //            ^^^^^^^^^                 ^^^^^^^^^^^^^
        //            Relationship type         Foreign key column
    }


    public function technicalTools()
    {
        return $this->belongsToMany(TechnicalTool::class,'offer_technical_tool')
            ->withPivot('proficiency_level', 'is_mandatory');
    }


}
