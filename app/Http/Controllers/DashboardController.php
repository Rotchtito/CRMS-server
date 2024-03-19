<?php

namespace App\Http\Controllers;

use App\Models\Complaint;

class DashboardController extends Controller
{
    public function casesOverTime()
{
    try {
        // Fetch cases over time data from your database
        $casesOverTimeData = Complaint::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Format the data for Chart.js
        $labels = $casesOverTimeData->pluck('date');
        $counts = $casesOverTimeData->pluck('count');

        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Cases Over Time',
                    'data' => $counts,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];

        // Return the data as JSON
        return response()->json($data);
    } catch (\Exception $e) {
        // Handle any errors that occur during the process
        return response()->json(['error' => 'Failed to retrieve cases over time'], 500);
    }
}

    public function casesByStatus()
    {
        try {
            // Fetch number of cases for each status
            $casesByStatus = Complaint::select('status', \DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status');

            // Return the data as JSON response
            return response()->json($casesByStatus);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => 'Failed to fetch cases by status'], 500);
        }
    }
}
