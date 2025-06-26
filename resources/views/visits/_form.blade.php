<form action="{{ $action }}" method="{{ $method }}" class="space-y-6">
    @csrf
    @if ($method == 'PUT')
        @method('PUT')
    @endif

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center mb-6">{{ $visit->exists ? 'Modifier' : 'Ajouter' }} une visite</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="visitor_id" class="block text-sm font-medium text-gray-700">Visiteur</label>
                    <select name="visitor_id" id="visitor_id" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Sélectionner un visiteur</option>
                        @foreach($visitors as $visitor)
                            <option value="{{ $visitor->id }}" {{ old('visitor_id', $visit->visitor_id) == $visitor->id ? 'selected' : '' }}>
                                {{ $visitor->last_name }} {{ $visitor->first_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('visitor_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tenant_id" class="block text-sm font-medium text-gray-700">Locataire</label>
                    <select name="tenant_id" id="tenant_id" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
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
                    <label for="arrival_time" class="block text-sm font-medium text-gray-700">Heure d'arrivée</label>
                    <input type="datetime-local" name="arrival_time" id="arrival_time" 
                           value="{{ old('arrival_time', $visit->arrival_time ? $visit->arrival_time->format('Y-m-d\TH:i') : '') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('arrival_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700">Motif de la visite</label>
                    <input type="text" name="purpose" id="purpose" 
                           value="{{ old('purpose', $visit->purpose ?? '') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('purpose')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{ $visit->exists ? 'Modifier' : 'Ajouter' }}</button>
            </div>
        </div>
    </div>
</form>
