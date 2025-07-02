@extends('base', [
    'title' => 'Liste des agents de sécurité',
    'pageTitle' => 'Liste des agents de sécurité',
])

@section('content')

<div class="mb-6">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des agents de sécurité</h2>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Nouvel agent
        </a>
    </div>

<form action="{{ route('users.index') }}" method="GET" class="w-full mb-6">
  <div class="flex">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Rechercher un agent"
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



<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Liste des agents de sécurité</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Nom</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Date de création</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Nb visites du jour</th>
                    <th class="px-6 py-3 text-center font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->created_at->translatedFormat('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->visits_count }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="relative inline-block text-left">
                               
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                <div class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-10 dropdown-menu">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-pencil"></i> Modifier</a>
                                    <a href="{{ route('users.show', $user) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-eye"></i> Voir</a>
                                    <button type="button"
                                            data-action="{{ route('users.destroy', $user) }}"
                                            data-role="delete-model"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucun agent de sécurité enregistré.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
