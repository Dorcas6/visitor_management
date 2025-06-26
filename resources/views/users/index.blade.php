@extends('base', [
    'title' => 'Liste des agents de sécurité',
    'pageTitle' => 'Liste des agents de sécurité',
])


@section('content')

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
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->created_at->translatedFormat('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->visits_count }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="relative inline-block text-left">
                                <button onclick="toggleDropdown(this)"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                    </svg>
                                </button>

                                <div class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-10 dropdown-menu">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-pencil"></i> Modifier</a>
                                    <a href="{{ route('users.show', $user) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fa fa-eye"></i> Voir</a>
                                    <button type="button"
                                            data-action="{{ route('users.destroy', $user) }}"
                                            data-role="delete-user"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @include('partials._delete-modal', ['action' => route('users.destroy', $user)])
                @endforeach
            </tbody>
        </table>
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

<script>
        const modalOverlay = document.getElementById('modalOverlay');
        const modalContent = document.getElementById('modalContent');
        const closeModalBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        let deleteForm = document.getElementById("delete-form");

        // Fonction pour ouvrir le modal
        function openModal(event) {
            console.log("Event:", event);
            
            modalOverlay.classList.remove('hidden');
            deleteForm.action = event.target.getAttribute("data-action")
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Fonction pour fermer le modal
        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modalOverlay.classList.add('hidden');
            }, 300);
        }

        
        // Event listeners
        document.querySelectorAll('[data-role="delete-user"]').forEach(openModalBtn => {
            openModalBtn.addEventListener('click', openModal);
        });
        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        
        // Fermer le modal en cliquant sur l'overlay
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });

        // Fermer le modal avec la touche Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalOverlay.classList.contains('hidden')) {
                closeModal();
            }
        });

        // Action du bouton confirmer
        confirmBtn.addEventListener('click', () => {
            closeModal();
            deleteForm.submit();
        });
    </script>
@endsection
