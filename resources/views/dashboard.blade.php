@extends('base')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Tableau de bord</h1>
    
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Carte Visites totales -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visites totales</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_visits'], 0, ',', ' ') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visites aujourd'hui -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-calendar-day text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visites aujourd'hui</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['today_visits'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visiteurs uniques -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-user-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visiteurs uniques</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['unique_visitors'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visites en cours -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visites en cours</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['active_visits'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique et Dernières visites -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Graphique -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Activité des visites (6 derniers mois)</h2>
            <canvas id="visitsChart" height="300"></canvas>
        </div>

        <!-- Dernières visites -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Dernières visites</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentVisits as $visit)
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">{{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $visit->created_at->format('d/m/Y H:i') }}
                                    @if($visit->time_out)
                                        <span class="text-green-500 ml-2">Terminée</span>
                                    @else
                                        <span class="text-yellow-500 ml-2">En cours</span>
                                    @endif
                                </p>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $visit->tenant->name ?? 'Visiteur' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 p-4">Aucune visite récente</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('visitsChart').getContext('2d');
    const monthlyData = @json($monthlyStats);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [{
                label: 'Nombre de visites',
                data: monthlyData.map(item => item.visits),
                backgroundColor: 'rgba(79, 70, 229, 0.7)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush

@endsection
