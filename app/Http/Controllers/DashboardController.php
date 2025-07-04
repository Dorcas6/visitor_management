<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth('tenants')->check()) {
            return $this->tenantDashboard();
        }
        
        return $this->agentDashboard();
    }

    protected function agentDashboard()
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

    public function tenantDashboard()
    {
        $tenant = auth('tenants')->user();
        
        // Vérifier si le locataire est bien authentifié
        if (!$tenant) {
            abort(403, 'Accès non autorisé.');
        }

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Statistiques pour le locataire
        $stats = [
            'today_visits' => $tenant->visits()->whereDate('time_in', $today)->count(),
            'active_visits' => $tenant->visits()->whereNull('time_out')->count(),
            'monthly_visits' => $tenant->visits()
                ->whereBetween('time_in', [$startOfMonth, $endOfMonth])
                ->count(),
        ];

        // Dernières visites du locataire
        $recentVisits = $tenant->visits()
            ->with('visitor')
            ->latest('time_in')
            ->take(5)
            ->get();

        return view('dashboard-tenant', compact('stats', 'recentVisits'));
    }
}
