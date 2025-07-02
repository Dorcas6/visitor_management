<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un visiteur</h2>
            <form action="{{ $action }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                @csrf
                @if (strtoupper($method) === 'PUT')
                    @method('PUT')
                @endif

                    <!-- Section Informations personnelles -->
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">
                            <i class="fas fa-user-circle mr-2 text-blue-600"></i>
                            Informations personnelles
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Nom -->
                            <div class="space-y-2">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">
                                    Nom <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" name="last_name" id="last_name" autocomplete="family-name"
                                    value="{{ old('last_name', $visitor->last_name) }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                </div>
                                @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Prénom -->
                            <div class="space-y-2">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">
                                    Prénom <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" name="first_name" id="first_name" autocomplete="given-name"
                                           value="{{ old('first_name', $visitor->first_name) }}"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           required>
                                </div>
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="space-y-2">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                    Téléphone <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="tel" name="phone_number" id="phone_number" autocomplete="tel"
                                           value="{{ old('phone_number', $visitor->phone_number) }}"
                                           placeholder="06 12 34 56 "
                                           pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Format: 90 00 10 25</p>
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- CNI -->
                            <div class="space-y-2">
                                <label for="icn" class="block text-sm font-medium text-gray-700">
                                    Numéro CNI <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-address-card text-gray-400"></i>
                                    </div>
                                    <input type="text" name="icn" id="icn"
                                           value="{{ old('icn', $visitor->icn) }}"
                                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           required>
                                </div>
                                @error('icn')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Photo -->
                            <!-- <div class="space-y-2 col-span-full">
                                <label class="block text-sm font-medium text-gray-700">
                                    Photo (optionnel)
                                </label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                        @if($visitor->photo_path)
                                            <img src="{{ asset('storage/' . $visitor->photo_path) }}" alt="Photo du visiteur" class="h-full w-full object-cover">
                                        @else
                                            <i class="fas fa-camera text-gray-400 text-2xl"></i>
                                        @endif
                                    </div>
                                    <div class="flex items-center">
                                        <label for="photo" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <span>Choisir une photo</span>
                                            <input id="photo" name="photo" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> -->
                    </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between items-center pt-5 border-t border-gray-200">
                    <a href="{{ route('visitors.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        {{ $visitor->exists ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Animation pour les champs obligatoires */
    input:required, select:required, textarea:required {
        border-left: 2px solid #3b82f6;
    }
    
    /* Style pour les erreurs de validation */
    .error-input {
        @apply border-red-500 focus:ring-red-500 focus:border-red-500;
    }
    
    /* Animation pour les champs au focus */
    input:focus, select:focus, textarea:focus {
        @apply ring-2 ring-blue-500 border-blue-500;
    }
</style>
@endpush
