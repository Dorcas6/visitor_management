<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Enregistrer une visite</h2>

        <form action="{{ $action }}" method="{{ strtolower($method) === 'put' ? 'POST' : $method }}">
            @csrf
            @if (strtoupper($method) === 'PUT')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="visitor_id" class="block text-sm font-medium text-gray-700 mb-1">Visiteur</label>
                    <select name="visitor_id" id="visitor_id" 
                            class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionner un visiteur</option>
                        @foreach($visitors as $visitor)
                            <option value="{{ $visitor->id }}" {{ old('visitor_id', $visit->visitor_id) == $visitor->id ? 'selected' : '' }}>
                                {{ $visitor->last_name }} {{ $visitor->first_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('visitor_id')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-1">Locataire</label>
                    <select name="tenant_id" id="tenant_id" 
                            class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionner un locataire</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id', $visit->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->name }} - {{ $tenant->apartment }}
                            </option>
                        @endforeach
                    </select>
                    @error('tenant_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="time_in" class="block text-sm font-medium text-gray-700 mb-1">Heure d'arrivée</label>
                    <input type="datetime-local" name="time_in" id="time_in" 
                           value="{{ old('time_in', $visit->time_in ? $visit->time_in->format('Y-m-d\TH:i') : '') }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('time_in')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>   
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Motif de la visite</label>
                    <input type="text" name="purpose" id="purpose" 
                           value="{{ old('purpose', $visit->purpose ?? '') }}" 
                           class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('purpose')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-6 text-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
