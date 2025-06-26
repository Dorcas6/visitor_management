@extends('base', [
    'title' => 'Liste des locataires',
    'pageTitle' => 'Liste des locataires',
])

@section('content')

<form action="{{ route('tenants.index') }}" method="GET" class="w-full mb-6">
  <div class="flex">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Rechercher un locataire"
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Appartement</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de visites</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tenants as $tenant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tenant->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tenant->apartment }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tenant->visits_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 dropdown-menu">
                                        <div class="py-1">
                                            <a href="{{ route('tenants.edit', $tenant) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="far fa-edit mr-2"></i>Modifier
                                            </a>
                                            <a href="{{ route('tenants.show', $tenant) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="far fa-eye mr-2"></i>Voir
                                            </a>
                                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100" data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                <i class="far fa-trash-alt mr-2"></i>Supprimer
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('partials._delete-modal', ['action' => route('tenants.destroy', $tenant)])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('hidden');
    }
</script>
@endsection
