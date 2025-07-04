@extends('base', [
    'title' => 'Liste des visiteurs',
    'pageTitle' => 'Liste des visiteurs',
])

@section('content')

<div class="mb-6">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des visiteurs</h2>
        @if(!auth("tenants")->check())
            <a href="{{ route('visitors.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Nouveau Visiteur
            </a>
        @endif
    </div>

<!-- Barre de recherche -->

<form action="{{ route('visitors.index') }}" method="GET" class="w-full mb-6">
  <div class="flex">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Rechercher un visiteur..."
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

<div class="bg-white shadow-md rounded-xl overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Liste des visiteurs</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Prénom</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Téléphone</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">CNI</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nombre de visites</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($visitors as $visitor)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->first_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->phone_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->icn }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->visits_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('visitors.show', $visitor) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('visitors.edit', $visitor) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button type="button" 
                                        data-action="{{ route('visitors.destroy', $visitor) }}"
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
                            Aucun visiteur enregistré.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection


