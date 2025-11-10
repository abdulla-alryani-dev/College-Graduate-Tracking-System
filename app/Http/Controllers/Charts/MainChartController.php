<?php
    namespace App\Http\Controllers\Charts;

    use App\Http\Controllers\Controller;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;


    class MainChartController extends Controller
    {



        public function getChartData(Request $request)
        {
            $year = $request->query('year', date('Y')); // Default to the current year

            // Query job offers (grouped by creation month)
            $jobOffers = DB::table('offers')
                ->selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', $year) // Filter by year
                ->groupBy(DB::raw('strftime("%m", created_at)'))
                ->get();


            // Query graduates with job status 1 (grouped by creation month)
            $graduatesWithJobs = DB::table('job_graduate')
                ->join('graduates', 'job_graduate.graduate_id', '=', 'graduates.id')
                ->where('graduates.job_status', 1)
                ->whereYear('job_graduate.created_at', $year) // Filter by year
                ->selectRaw('strftime("%m", job_graduate.created_at) as month, COUNT(*) as count')
                ->groupBy(DB::raw('strftime("%m", job_graduate.created_at)'))
                ->get();


            // Combine data
            $months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            $jobOffersData = array_fill(0, 12, 0); // Initialize array for job offers
            $graduatesData = array_fill(0, 12, 0); // Initialize array for graduates

            // Populate job offers data
            foreach ($jobOffers as $offer) {
                $monthIndex = (int)$offer->month - 1; // Convert "01" to 0, "02" to 1, etc.
                if ($monthIndex >= 0 && $monthIndex < 12) { // Ensure the index is valid
                    $jobOffersData[$monthIndex] = $offer->count;
                }
            }

            // Populate graduates data
            foreach ($graduatesWithJobs as $graduate) {
                $monthIndex = (int)$graduate->month - 1; // Convert "01" to 0, "02" to 1, etc.
                if ($monthIndex >= 0 && $monthIndex < 12) { // Ensure the index is valid
                    $graduatesData[$monthIndex] = $graduate->count;
                }
            }

            // Prepare chart data
            $chartData = [
                'labels' => $months,
                'datasets' => [
                    [
                        "label" => "الخريجين الموظفين",
                        "backgroundColor" => "rgba(0, 123, 255, 0.1)",
                        "borderColor" => "#007bff",
                        "pointHoverBackgroundColor" => "#fff",
                        "borderWidth" => 2,
                        "data" => $graduatesData,
                        "fill" => true
                    ],
                    [
                        "label" => "الوظائف المتاحة",
                        "borderColor" => "#28a745",
                        "pointHoverBackgroundColor" => "#fff",
                        "borderWidth" => 2,
                        "data" => $jobOffersData
                    ]
                ]
            ];

            return response()->json($chartData);
        }

        // Fetch distinct years from the graduates table
        public function getYears()
        {
            $years = DB::table('university_data')
                ->selectRaw('DISTINCT strftime("%Y",created_at) as year')
                ->orderBy('year', 'desc')
                ->pluck('year');

            return response()->json($years);
        }


    }
