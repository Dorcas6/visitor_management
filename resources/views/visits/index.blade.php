@extends("base")

@section('content')

<form action="{{ route('visits.index') }}" method="GET" class="w-full mb-6">
  <div class="flex">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Rechercher une visite"
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

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Agent</th>
                        <th class="px-4 py-2">Visiteur</th>
                        <th class="px-4 py-2">Locataire</th>
                        <th class="px-4 py-2">Heure d'arrivée</th>
                        <th class="px-4 py-2">Heure de départ</th>
                        <th class="px-4 py-2">Motif</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($visits as $visit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                {{ $visit->user->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $visit->visitor->last_name }} {{ $visit->visitor->first_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $visit->tenant->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{($visit->time_in)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-2">
                                @if($visit->time_out)
                                    {{$visit->time_out->format('d/m/Y H:i') }}
                                @else
                                    <form action="{{ route('visits.mark-departure', $visit) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                            <i class="fas fa-door-open mr-1"></i>Marquer le départ
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $visit->purpose }}</td>
                            <td class="px-4 py-2">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="text-gray-600 hover:text-gray-800 focus:outline-none"
                                        onclick="event.stopPropagation(); this.nextElementSibling.classList.toggle('hidden')">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden z-10">
                                        <a href="{{ route('visits.edit', $visit) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="far fa-edit mr-2"></i>Modifier
                                        </a>
                                        <a href="{{ route('visits.show', $visit) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="far fa-eye mr-2"></i>Voir
                                        </a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <i class="far fa-trash-alt mr-2"></i>Supprimer
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('partials._delete-modal', ['action' => route('visits.destroy', $visit)])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
