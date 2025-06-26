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

            <div class="mt-6 text-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow">
                    Soumettre
                </button>
            </div>
        </form>
    </div>
</div>
