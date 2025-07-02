<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un agent de sécurité</h2>

        <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom complet -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-sm text-red-500">@error("name") {{ $message }} @enderror</span>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-sm text-red-500">@error("email") {{ $message }} @enderror</span>
                </div>
                
            </div>
            <!-- Boutons d'action -->
                <div class="flex justify-between items-center pt-5 border-t border-gray-200">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        {{ $user->exists ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
        </form>
    </div>
</div>
