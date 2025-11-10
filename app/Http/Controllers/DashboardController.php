<?php

namespace App\Http\Controllers;

use App\Models\Employeer;
use App\Models\Graduate;
use App\Models\Job;
use App\Models\Supervisor;
use App\Models\Offer;
use Carbon\Carbon;

use App\Models\UniversityData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // Basic counts

        $graduatesCount = Graduate::count();
        $supervisorsCount =DB::table('users')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where('roles.name', 'supervisor')
        ->count();

        $employeersCount = Employeer::count();
        $universityDataCount = UniversityData::count();
        $offers = Offer::with('employeer')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        // Graduate data with relationships
        $graduates = Graduate::with('universityData')->get();

        // Employment status counts
        $employedGraduates = Graduate::where('job_status', true)->count();
        $graduatesWithoutJobCount = Graduate::where('job_status', false)->count();
        $graduatesOutOfHomeCount = Graduate::whereHas('jobs', function($query) {
            $query->where('location', '!=', 'home') // Adjust if your "home" value is different
                  ->where(function($q) {
                      $q->whereNull('job_graduate.end_date')
                        ->orWhere('job_graduate.end_date', '>', now());
                  });
        })->count();

        // Group by graduation year for trends
        $graduateData = $graduates->groupBy(function($graduate) {
            return $graduate->universityData->graduation_year;
        })->map(function($graduatesByYear) {
            $totalGraduates = $graduatesByYear->count();
            $graduatesWithJob = $graduatesByYear->where('job_status', true)->count();
            return $totalGraduates > 0 ? round(($graduatesWithJob / $totalGraduates) * 100, 2) : 0;
        });

        // University major distribution
        $universityData = UniversityData::all();
        $majors = $universityData->groupBy('major')->map->count();
        $totalRecords = $universityData->count();

        $majorsData = $majors->map(function($count) use ($totalRecords) {
            return $totalRecords > 0 ? round(($count / $totalRecords) * 100, 2) : 0;
        });

        // Chart data preparation
        $jsonMajors = $majorsData->keys()->toArray();
        $jsonPercentages = $majorsData->values()->toArray();
        $majorColors = array_map(fn() => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), $jsonMajors);

        // Job-graduate relationships
        $jobGraduateData = DB::table('job_graduate')
            ->join('jobs', 'job_graduate.job_id', '=', 'jobs.id')
            ->select('jobs.title as job_title', DB::raw('COUNT(*) as graduate_count'))
            ->groupBy('jobs.title')
            ->get()
            ->mapWithKeys(function($item) use ($graduatesCount) {
                return [$item->job_title => round(($item->graduate_count / $graduatesCount) * 100, 2)];
            });

        // Percentage calculations
        $graduatesWithoutJobPercentage = $graduatesCount===0 ? 0 :round(($graduatesWithoutJobCount / $graduatesCount) * 100, 2);
        $graduatesOutOfHomePercentage =  $graduatesCount===0 ? 0 : round(($graduatesOutOfHomeCount / $graduatesCount) * 100, 2);
        $employmentRatePercentage =  $graduatesCount===0 ? 0 : round(($employedGraduates / $graduatesCount) * 100, 2);

        // Growth rate calculations
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;

        // Employment growth
        $currentEmployed = Graduate::where('job_status', true)
            ->whereYear('created_at', $currentYear)
            ->count();

        $previousEmployed = Graduate::where('job_status', true)
            ->whereYear('created_at', $previousYear)
            ->count();

        $employmentGrowthPercentage = $previousEmployed > 0
            ? round((($currentEmployed - $previousEmployed) / $previousEmployed) * 100, 2)
            : ($currentEmployed > 0 ? 100 : 0);

        // Job growth (using distinct employers)
        $currentYear = Carbon::now()->year;
            $previousYear = $currentYear - 1;

            // Current year job offers
            $currentYearOffers = Offer::whereYear('created_at', $currentYear)
                ->count();

            // Previous year job offers
            $previousYearOffers = Offer::whereYear('created_at', $previousYear)
                ->count();

            // Calculate growth percentage
            $jobGrowthPercentage = ($previousYearOffers > 0)
                ? round((($currentYearOffers - $previousYearOffers) / $previousYearOffers) * 100, 2)
                : ($currentYearOffers > 0 ? 100 : 0);

        return view('dashboard.index', compact(
            // Basic counts
            'graduatesCount',
            'supervisorsCount',
            'employeersCount',
            'universityDataCount',

            // Chart data
            'jsonMajors',
            'jsonPercentages',
            'majorColors',
            'graduateData',
            'jobGraduateData',

            // Employment metrics
            'graduatesWithoutJobCount',
            'graduatesWithoutJobPercentage',
            'graduatesOutOfHomeCount',
            'graduatesOutOfHomePercentage',
            'employmentRatePercentage',
            'employmentGrowthPercentage',
            'jobGrowthPercentage',

            // Additional useful counts
            'employedGraduates',
            'offers'
        ));
    }



    public function graduateDashboard(){

        return view('graduate.dashboard');
    }


}
