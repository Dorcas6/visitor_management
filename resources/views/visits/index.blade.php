@extends("base")

@section('content')

<div class="mb-6">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des visites</h2>
        <a href="{{ route('visits.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Nouvelle visite
        </a>
    </div>

    <!-- Onglets de navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('visits.index', ['status' => 'ongoing']) }}" 
               class="{{ !request()->has('status') || request('status') === 'ongoing' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Visites en cours
                <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ \App\Models\Visit::whereNull('time_out')->count() }}
                </span>
            </a>
            <a href="{{ route('visits.index', ['status' => 'completed']) }}" 
               class="{{ request('status') === 'completed' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Visites terminées
                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ \App\Models\Visit::whereNotNull('time_out')->count() }}
                </span>
            </a>
        </nav>
    </div>

    <!-- Barre de recherche -->
    <form action="{{ route('visits.index') }}" method="GET" class="w-full mb-6">
        <div class="flex">
            @if(request()->has('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Rechercher une visite..."
                class="w-full px-4 py-2 border rounded-l-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
            >
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Visiteur</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Locataire</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Heure d'arrivée</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Heure de départ</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Motif</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($visits as $visit)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $visit->visitor->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $visit->tenant->name }}</div>
                            <div class="text-sm text-gray-500">{{ $visit->tenant->apartment }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $visit->time_in->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($visit->time_out)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $visit->time_out->format('d/m/Y H:i') }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    En cours
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $visit->purpose }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                @if(!$visit->time_out)
                                    <form action="{{ route('visits.mark-departure', $visit) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900"
                                                title="Terminer la visite">
                                            <i class="fas fa-check-circle text-lg"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('visits.show', $visit) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('visits.edit', $visit) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button type="button" 
                                        data-action="{{ route('visits.destroy', $visit) }}"
                                        data-role="delete-model"
                                        class="text-red-600 hover:text-red-900">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucune visite enregistrée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($visits->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $visits->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@include('partials._delete-modal')

@endsection