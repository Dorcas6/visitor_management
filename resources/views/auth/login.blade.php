<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl w-full">
        
        <!-- Image ou illustration (visible uniquement sur md et plus) -->
        <div class="hidden md:flex md:w-1/2 bg-gray-800 items-center justify-center p-8">
        <img src="/images/login-security-image.png"  class="w-full h-full object-cover">
        </div>

        <!-- Formulaire -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse e-mail</label>
                    <input placeholder=" Veuillez entrer votre adresse e-mail" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de passe</label>
                    <input placeholder=" Veuillez entrer votre mot de passe" id="password" type="password" name="password" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
    <span class="block text-sm font-medium text-gray-700 mb-1 text-center">Choisissez votre profil</span>
    <div class="flex space-x-8 mb-3 justify-center">

        <label class="inline-flex items-center">
            <input type="radio" name="profile" value="agent" class="text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
            <span class="ml-2 text-gray-700">Agent de sécurité</span>
        </label>

        <label class="inline-flex items-center">
            <input type="radio" name="profile" value="locataire" class="text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
            <span class="ml-2 text-gray-700">Locataire</span>
        </label>
        @error('profile')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>


                <div class="mb-4 flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
                        <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Mot de passe oublié ?</a>
                </div>

                <button type="submit"
                    class="w-full bg-gray-800 text-white font-semibold py-2 rounded-lg hover:bg-gray-900 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                </button>
            </form>

            <p class="mt-6 text-sm text-center text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Créer un compte</a>
            </p>
        </div>
    </div>
</body>
</html>
