<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques de base
        $stats = [
            'total_visits' => Visit::count(),
            'today_visits' => Visit::whereDate('created_at', today())->count(),
            'unique_visitors' => Visitor::has('visits')->count(),
            'active_visits' => Visit::whereNull('time_out')->count(),
        ];

        // Dernières visites (10 plus récentes)
        $recentVisits = Visit::with(['visitor', 'tenant'])
            ->latest()
            ->take(10)
            ->get();

        // Statistiques des 6 derniers mois
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'visits' => Visit::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return view('dashboard', compact('stats', 'recentVisits', 'monthlyStats'));
    }
}
