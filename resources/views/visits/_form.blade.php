<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            {{ $visit->exists ? 'Modifier' : 'Enregistrer' }} une visite
        </h2>
        
        <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}" class="space-y-8">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            <!-- Section Informations de la visite -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6 pb-2 border-b border-gray-200">
                    <i class="fas fa-calendar-check mr-2 text-blue-600"></i>
                    Informations de la visite
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Visiteur -->
                    <div class="space-y-2">
                        <label for="visitor_id" class="block text-sm font-medium text-gray-700">
                            Visiteur <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400"></i>
                            </div>
                            <select name="visitor_id" id="visitor_id"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                <option value="">Sélectionner un visiteur</option>
                                @foreach($visitors as $visitor)
                                    <option value="{{ $visitor->id }}" {{ old('visitor_id', $visit->visitor_id) == $visitor->id ? 'selected' : '' }}>
                                        {{ $visitor->last_name }} {{ $visitor->first_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('visitor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Locataire -->
                    <div class="space-y-2">
                        <label for="tenant_id" class="block text-sm font-medium text-gray-700">
                            Locataire <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-building text-gray-400"></i>
                            </div>
                            <select name="tenant_id" id="tenant_id"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                <option value="">Sélectionner un locataire</option>
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ old('tenant_id', $visit->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                        {{ $tenant->name }} ({{ $tenant->apartment }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tenant_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date et heure d'arrivée -->
                    <div class="space-y-2">
                        <label for="time_in" class="block text-sm font-medium text-gray-700">
                            Date et heure d'arrivée <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            <input type="datetime-local" name="time_in" id="time_in"
                                   value="{{ old('time_in', $visit->exists ? \Carbon\Carbon::parse($visit->time_in)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                        </div>
                        @error('time_in')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date et heure de départ -->
                    <div class="space-y-2">
                        <label for="time_out" class="block text-sm font-medium text-gray-700">
                            Date et heure de départ
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-sign-out-alt text-gray-400"></i>
                            </div>
                            <input type="datetime-local" name="time_out" id="time_out"
                                   value="{{ old('time_out', $visit->time_out ? \Carbon\Carbon::parse($visit->time_out)->format('Y-m-d\TH:i') : '') }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        @error('time_out')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Motif de la visite -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="purpose" class="block text-sm font-medium text-gray-700">
                            Motif de la visite
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                <i class="fas fa-clipboard text-gray-400"></i>
                            </div>
                            <textarea name="purpose" id="purpose" rows="3"
                                      class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('purpose', $visit->purpose) }}</textarea>
                        </div>
                        @error('purpose')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-between items-center pt-5 border-t border-gray-200">
                <a href="{{ route('visits.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-times mr-2"></i>
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i>
                    {{ $visit->exists ? 'Mettre à jour' : 'Enregistrer' }}
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
    
    /* Style pour les selects avec icônes */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    
    /* Style pour les textareas avec icônes */
    textarea {
        min-height: 100px;
        resize: vertical;
    }
</style>
@endpush
