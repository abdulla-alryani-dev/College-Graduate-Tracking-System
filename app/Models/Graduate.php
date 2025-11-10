<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Graduate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_status',
        'university_data_id',
        'skills_id',
    ];

    protected function casts(): array
    {
        return [
            'job_status' => 'boolean',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function universityData()
    {
        return $this->belongsTo(UniversityData::class, 'university_data_id', 'id');
    }

    public function courses()
    {
    return $this->belongsToMany(Course::class, 'course_graduate');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_graduate')
            ->withPivot(['start_date', 'end_date'])
            ->withTimestamps();
    }
    public function skills()
    {
    return $this->belongsToMany(Skill::class, 'skill_graduate');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    public function story()
{
    return $this->hasOne(GraduateStory::class);
}

    // app/Models/Graduate.php

    public static function employmentPercentageByYear()
    {
        $result = [];

        // Get all years with employment data
        $years = DB::table('job_graduate')
            ->select(DB::raw('DISTINCT YEAR(start_date) as year'))
            ->whereNotNull('start_date')
            ->orderBy('year')
            ->pluck('year');

        foreach ($years as $year) {
            $employedCount = DB::table('job_graduate')
                ->whereYear('start_date', $year)
                ->distinct('graduate_id')
                ->count('graduate_id');

            $totalGraduates = static::whereYear('graduation_date', '<=', $year)->count();

            $percentage = $totalGraduates > 0 ? ($employedCount / $totalGraduates) * 100 : 0;

            $result[$year] = [
                'employed_count' => $employedCount,
                'total_graduates' => $totalGraduates,
                'percentage' => round($percentage, 2)
            ];
        }

        return $result;
    }


}
