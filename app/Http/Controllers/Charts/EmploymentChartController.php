<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmploymentChartController extends Controller
{

    public function getEmploymentStatistics()
    {

        $employmentData = DB::table('job_graduate')
            ->selectRaw("strftime('%Y', created_at) as year, COUNT(*) as count")
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        return response()->json([
            'years' => $employmentData->pluck('year'),
            'counts' => $employmentData->pluck('count')
        ]);

    }




}
