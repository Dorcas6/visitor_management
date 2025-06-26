
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-md">
        <!-- En-tête de la carte -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $visitor->exists ? 'Modifier' : 'Ajouter' }} un visiteur
            </h2>
        </div>

        <!-- Contenu de la carte -->
        <div class="p-6">
            <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}" class="space-y-6">
                @csrf
                @if (strtoupper($method) === 'PUT')
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="last_name" id="last_name"
                               value="{{ old('last_name', $visitor->last_name) }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="first_name" id="first_name"
                               value="{{ old('first_name', $visitor->first_name) }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                        <input type="tel" name="phone_number" id="phone_number"
                               value="{{ old('phone_number', $visitor->phone_number) }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CNI -->
                    <div>
                        <label for="icn" class="block text-sm font-medium text-gray-700">Numéro du CNI</label>
                        <input type="text" name="icn" id="icn"
                               value="{{ old('icn', $visitor->icn) }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        @error('icn')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pied de la carte avec bouton -->
                <div class="pt-6 text-end border-t border-gray-200">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                        {{ $visitor->exists ? 'Modifier' : 'Ajouter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
