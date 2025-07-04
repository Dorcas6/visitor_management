@extends('base')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-8">Tableau de bord</h1>
    
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Carte Visites aujourd'hui -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-calendar-day text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visites aujourd'hui</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['today_visits'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte Visites en cours -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
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

        <!-- Carte Visites ce mois -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Visites ce mois</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['monthly_visits'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières visites -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Dernières visites</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Visiteur
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Heure d'arrivée
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Détails</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentVisits as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $visit->visitor->company_name ?? 'Aucune entreprise' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->time_in->format('d/m/Y H:i') }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $visit->time_in->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($visit->time_out)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terminée
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        En cours
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('visits.show', $visit) }}" class="text-blue-600 hover:text-blue-900">
                                    Voir détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                Aucune visite récente
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
