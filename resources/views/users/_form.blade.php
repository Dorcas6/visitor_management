<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            {{ $user->exists ? 'Modifier' : 'Ajouter' }} un agent de sécurité
        </h2>
        
        <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}" class="space-y-8">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            <!-- Section Informations de l'agent -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">
                    <i class="fas fa-user-shield mr-2 text-blue-600"></i>
                    Informations de l'agent
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom complet -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nom complet <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            {{ $user->exists ? 'Nouveau mot de passe' : 'Mot de passe' }}
                            @if(!$user->exists) <span class="text-red-500">*</span> @endif
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   {{ $user->exists ? '' : 'required' }}
                                   autocomplete="new-password">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirmer le mot de passe
                            @if(!$user->exists) <span class="text-red-500">*</span> @endif
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   {{ $user->exists ? '' : 'required' }}
                                   autocomplete="new-password">
                        </div>
                    </div>
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

@push('styles')
<style>
    /* Animation pour les champs obligatoires */
    [required] + label::after {
        content: '*';
        @apply text-red-500 ml-1;
    }
    
    /* Style pour les champs en erreur */
    .border-red-500 {
        @apply border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500;
    }
    
    /* Animation au focus */
    input:focus, select:focus, textarea:focus {
        @apply ring-2 ring-blue-200;
    }
</style>
@endpush
