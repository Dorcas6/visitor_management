@extends('base', [
    'title' => 'Liste des visiteurs',
    'pageTitle' => 'Liste des visiteurs',
])

@section('content')

<form action="{{ route('visitors.index') }}" method="GET" class="w-full mb-6">
  <div class="flex">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Rechercher un visiteur"
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

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    @foreach($visitors as $visitor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->icn }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visitor->visits_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none"
                                            onclick="toggleDropdown(this)">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                                        </svg>
                                    </button>
                                    <div class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-10 dropdown-menu">
                                    <a href="{{ route('visitors.edit', $visitor) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-pencil"></i> Modifier</a>
                                    <a href="{{ route('visitors.show', $visitor) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-eye"></i> Voir</a>
                                    <button type="button"
                                            data-action="{{ route('visitors.destroy', $visitor) }}"
                                            data-role="delete-visitor"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </button>
                                </div>
                                    
                                </div>
                            </td>
                        </tr>

                        {{-- Modal suppression --}}
                        @include('partials._delete-modal', ['action' => route('visitors.destroy', $visitor), 'modalId' => 'delete-modal-' . $visitor->id])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function toggleDropdown(button) {
        const menu = button.nextElementSibling;
        menu.classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (!menu.previousElementSibling.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
@endsection

@section('style')
<!-- Pas besoin de DataTables, Tailwind suffit ici -->
@endsection
