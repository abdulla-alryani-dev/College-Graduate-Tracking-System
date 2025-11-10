<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class TechnologyChartController extends Controller
{
    public function getTechnologiesData()
    {
        // Get top 10 most in-demand technologies
        $technologies = Job::select(
                'technology',
                DB::raw('COUNT(*) as job_count')
            )
            ->whereNotNull('technology')
            ->where('technology', '!=', '')
            ->groupBy('technology')
            ->orderByDesc('job_count')
            ->limit(10)
            ->get();

        // Calculate percentages
        $totalJobs = Job::count();
        $techData = $technologies->mapWithKeys(function($item) use ($totalJobs) {
            $percentage = $totalJobs > 0 ? round(($item->job_count / $totalJobs) * 100) : 0;
            return [$item->technology => $percentage];
        });

        $colors = [
            '#4361ee', '#3f37c9', '#4895ef', '#4cc9f0', '#38a169',
            '#2ec4b6', '#f72585', '#b5179e', '#7209b7', '#560bad'
        ];

        return response()->json([
            'technologies' => $techData->keys()->toArray(),
            'percentages' => $techData->values()->toArray(),
            'counts' => $technologies->pluck('job_count')->toArray(),
            'colors' => array_slice($colors, 0, $technologies->count()),
            'total_jobs' => $totalJobs
        ]);
    }
}
