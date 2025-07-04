@extends('base', [
    'title' => 'Détails de la visite',
])

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Détails de la visite</h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ $visit->created_at->translatedFormat('d F Y') }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('visits.edit', $visit) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-edit mr-2"></i>
                Modifier
            </a>
            <a href="{{ route('visits.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Carte d'information principale -->
    <x-detail-card title="Informations de la visite" icon="calendar-check">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Visiteur</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-user-tag text-gray-400 mr-2"></i>
                    {{ $visit->visitor->last_name }} {{ $visit->visitor->first_name }}
                </p>
                @if($visit->visitor->phone)
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-phone text-gray-400 mr-2"></i>
                    {{ $visit->visitor->phone }}
                </p>
                @endif
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Locataire</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-building text-gray-400 mr-2"></i>
                    {{ $visit->tenant->name }}
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-door-open text-gray-400 mr-2"></i>
                    Appartement {{ $visit->tenant->apartment }}
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Heure d'arrivée</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-sign-in-alt text-gray-400 mr-2"></i>
                    {{ $visit->time_in->translatedFormat('d/m/Y H:i') }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $visit->time_in->diffForHumans() }}
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">
                    {{ $visit->time_out ? 'Heure de départ' : 'En cours de visite' }}
                </h4>
                <p class="text-lg {{ $visit->time_out ? 'text-gray-900' : 'text-green-600' }}">
                    <i class="fas {{ $visit->time_out ? 'fa-sign-out-alt' : 'fa-user-clock' }} text-gray-400 mr-2"></i>
                    {{ $visit->time_out ? $visit->time_out->translatedFormat('d/m/Y H:i') : 'En cours...' }}
                </p>
                @if($visit->time_out)
                <p class="text-sm text-gray-500 mt-1">
                    Durée: {{ $visit->time_out->diffForHumans($visit->arrival_time, true) }}
                </p>
                @endif
            </div>

            @if($visit->purpose)
            <div class="md:col-span-2 space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Motif de la visite</h4>
                <p class="text-gray-700">
                    <i class="fas fa-clipboard text-gray-400 mr-2"></i>
                    {{ $visit->purpose }}
                </p>
            </div>
            @endif
        </div>
    </x-detail-card>

    <!-- Section des actions -->
    @if(!$visit->time_out)
    <div class="mt-6 flex justify-end">
        <form action="{{ route('visits.mark-departure', $visit) }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Enregistrer le départ
            </button>
        </form>
    </div>
    @endif
</div>

@push('styles')
<style>
    .detail-item {
        @apply py-4 border-b border-gray-100 last:border-0;
    }
    .detail-label {
        @apply text-sm font-medium text-gray-500;
    }
    .detail-value {
        @apply mt-1 text-gray-900;
    }
</style>
@endpush

@endsection
