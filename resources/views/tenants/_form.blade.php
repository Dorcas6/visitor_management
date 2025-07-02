<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un locataire</h2>
        
        <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}" class="space-y-6">
                @csrf
                @if (strtoupper($method) === 'PUT')
                    @method('PUT')
                @endif  
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du locataire</label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name', $tenant->name) }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="apartment" class="block text-sm font-medium text-gray-700">Appartement</label>
                    <input type="text" name="apartment" id="apartment" 
                           value="{{ old('apartment', $tenant->apartment) }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('apartment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                    <input type="number" name="phone" id="phone" 
                           value="{{ old('phone', $tenant->phone) }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse-Email</label>
                    <input type="text" name="email" id="email" 
                           value="{{ old('email', $tenant->email) }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                </div>

                 <!-- Pied de la carte avec bouton -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                        {{ $tenant->exists ? 'Modifier' : 'Ajouter' }}
                    </button>
                </div>
        </form>

    </div>
</div>

