@extends('base', [
    'title' => 'Détails du locataire',
])

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-building text-blue-600 mr-2"></i>
                {{ $tenant->name }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Enregistré le {{ $tenant->created_at->translatedFormat('d F Y') }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('tenants.edit', $tenant) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-edit mr-2"></i>
                Modifier
            </a>
            <a href="{{ route('tenants.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Informations du locataire -->
    <x-detail-card title="Informations du locataire" icon="building">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Nom complet</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-user-tie text-gray-400 mr-2"></i>
                    {{ $tenant->name }}
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Appartement</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-door-open text-gray-400 mr-2"></i>
                    {{ $tenant->apartment }}
                </p>
            </div>

            @if($tenant->email)
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Email</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                    <a href="mailto:{{ $tenant->email }}" class="text-blue-600 hover:text-blue-800">
                        {{ $tenant->email }}
                    </a>
                </p>
            </div>
            @endif

            @if($tenant->phone)
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Téléphone</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-phone text-gray-400 mr-2"></i>
                    <a href="tel:{{ $tenant->phone }}" class="text-blue-600 hover:text-blue-800">
                        {{ $tenant->phone }}
                    </a>
                </p>
            </div>
            @endif

            @if($tenant->emergency_contact)
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Contact d'urgence</h4>
                <p class="text-gray-700">
                    <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                    {{ $tenant->emergency_contact }}
                    @if($tenant->emergency_phone)
                        - <a href="tel:{{ $tenant->emergency_phone }}" class="text-blue-600 hover:text-blue-800">{{ $tenant->emergency_phone }}</a>
                    @endif
                </p>
            </div>
            @endif
        </div>
    </x-detail-card>

    <!-- Dernières visites -->
    <x-detail-card title="Dernières visites" icon="history">
        @if($tenant->visits->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Visiteur
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tenant->visits->sortByDesc('time_in')->take(5) as $visit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $visit->time_in->translatedFormat('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $visit->time_in->format('H:i') }}
                                    @if($visit->time_out)
                                        - {{ $visit->time_out->format('H:i') }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}</div>
                                @if($visit->purpose)
                                <div class="text-sm text-gray-500 truncate max-w-xs" title="{{ $visit->purpose }}">
                                    {{ Str::limit($visit->purpose, 40) }}
                                </div>
                                @endif
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
                                    <i class="fas fa-eye"></i>
                                    <span class="sr-only">Voir</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($tenant->visits->count() > 5)
            <div class="mt-4 text-center">
                <a href="{{ route('visits.index', ['tenant_id' => $tenant->id]) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Voir toutes les visites ({{ $tenant->visits->count() }})
                </a>
            </div>
            @endif
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 opacity-50"></i>
                <p>Aucune visite enregistrée pour ce locataire</p>
            </div>
        @endif
    </x-detail-card>
</div>
@endsection
