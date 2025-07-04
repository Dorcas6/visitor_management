@extends('base', [
    'title' => 'Détails de l\'agent de sécurité',
])

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-user-shield text-blue-600 mr-2"></i>
                {{ $user->name }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Membre depuis {{ $user->created_at->translatedFormat('d F Y') }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-edit mr-2"></i>
                Modifier
            </a>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Informations du compte -->
    <x-detail-card title="Informations du compte" icon="user-cog">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Nom complet</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-user text-gray-400 mr-2"></i>
                    {{ $user->name }}
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Adresse email</h4>
                <p class="text-lg text-gray-900">
                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                    <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800">
                        {{ $user->email }}
                    </a>
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Rôle</h4>
                <p class="text-gray-700">
                    <i class="fas fa-user-tag text-gray-400 mr-2"></i>
                    @if($user->is_admin)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                            Administrateur
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Agent de sécurité
                        </span>
                    @endif
                </p>
            </div>

            <div class="space-y-1">
                <h4 class="text-sm font-medium text-gray-500">Dernière connexion</h4>
                <p class="text-gray-700">
                    <i class="fas fa-clock text-gray-400 mr-2"></i>
                    @if($user->last_login_at)
                        {{ $user->last_login_at->diffForHumans() }}
                        <span class="text-gray-500 text-sm">({{ $user->last_login_at->translatedFormat('d/m/Y H:i') }})</span>
                    @else
                        Jamais connecté
                    @endif
                </p>
            </div>
        </div>
    </x-detail-card>

    <!-- Activité récente -->
    <x-detail-card title="Activité récente" icon="history">
        @if($user->visits->count() > 0)
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
                                Locataire
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($user->visits->sortByDesc('created_at')->take(5) as $visit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $visit->time_in->translatedFormat('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $visit->time_in->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}</div>
                                @if($visit->visitor->phone)
                                <div class="text-sm text-gray-500">
                                    {{ $visit->visitor->phone }}
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $visit->tenant->name }}</div>
                                <div class="text-sm text-gray-500">
                                    Appt. {{ $visit->tenant->apartment }}
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($user->visits->count() > 5)
            <div class="mt-4 text-center">
                <a href="{{ route('visits.index', ['user_id' => $user->id]) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Voir toutes les visites ({{ $user->visits->count() }})
                </a>
            </div>
            @endif
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 opacity-50"></i>
                <p>Aucune activité enregistrée pour cet agent</p>
            </div>
        @endif
    </x-detail-card>
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
