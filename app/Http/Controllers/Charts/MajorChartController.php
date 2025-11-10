<?php
namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Models\UniversityData;

class MajorChartController extends Controller
{
    public function getMajorsData()
    {
        $universityData = UniversityData::all();

        // Group by major and calculate percentages
        $majors = $universityData->groupBy('major')->map(function ($group) use ($universityData) {
            $count = $group->count();
            $total = $universityData->count();
            return $total > 0 ? round(($count / $total) * 100, 2) : 0;
        });

        // Sort by percentage (descending) and take top 5
        $sortedMajors = $majors->sortDesc()->take(5);

        $colors = ['#4361ee', '#3f37c9', '#4895ef', '#4cc9f0', '#38a169'];

        return response()->json([
            'labels' => $sortedMajors->keys()->toArray(),
            'data' => $sortedMajors->values()->toArray(),
            'colors' => array_slice($colors, 0, $sortedMajors->count()),
            'total' => $universityData->count()
        ]);
    }

    public function exportMajorsData()
    {
        $universityData = UniversityData::all();

        $majors = $universityData->groupBy('major')->map(function ($group) use ($universityData) {
            $count = $group->count();
            $total = $universityData->count();
            return [
                'count' => $count,
                'percentage' => $total > 0 ? round(($count / $total) * 100, 2) : 0
            ];
        })->sortDesc();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="majors_distribution.csv"',
        ];

        $callback = function() use ($majors) {
            $file = fopen('php://output', 'w');
            // Add Arabic BOM for proper encoding in Excel
            fwrite($file, "\xEF\xBB\xBF");
            fputcsv($file, ['التخصص', 'عدد الطلاب', 'النسبة المئوية']);

            foreach ($majors as $major => $data) {
                fputcsv($file, [
                    $major,
                    $data['count'],
                    $data['percentage'] . '%'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
