<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
        }
        .password-container {
            position: relative;
        }
        .error-message {
            animation: fadeIn 0.3s ease-in-out;
            margin-top: 0.5rem;
            padding: 0.5rem;
            border-radius: 0.375rem;
            background-color: #FEE2E2;
            color: #B91C1C;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }
        .error-message i {
            margin-right: 0.5rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-loading .spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .btn-loading span {
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl w-full">
        
        <!-- Image ou illustration (visible uniquement sur md et plus) -->
        <div class="hidden md:flex md:w-1/2 bg-gray-800 items-center justify-center p-8">
            <img src="/images/login-security-image.png" class="w-full h-full object-cover">
        </div>

        <!-- Formulaire -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1">Adresse e-mail</label>
                    <input placeholder="Veuillez entrer votre adresse e-mail" 
                           type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Mot de passe</label>
                    <div class="password-container">
                        <input placeholder="Veuillez entrer votre mot de passe" 
                               id="password" 
                               type="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}">
                        <button type="button" id="togglePassword" class="password-toggle" aria-label="Afficher le mot de passe">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <span class="block text-sm font-medium text-gray-700 mb-2 text-center">Choisissez votre profil</span>
                    <div class="flex flex-col sm:flex-row sm:space-x-8 space-y-2 sm:space-y-0 mb-3 justify-center">
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="profile" 
                                   value="agent" 
                                   class="text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                                   required
                                   {{ old('profile') == 'agent' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Agent de sécurité</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="profile" 
                                   value="locataire" 
                                   class="text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                                   required
                                   {{ old('profile') == 'locataire' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Locataire</span>
                        </label>
                    </div>
                    @error('profile')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="mb-6 flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               class="form-checkbox text-blue-600 rounded"
                               {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Mot de passe oublié ?</a>
                </div>

                <button type="submit"
                        id="loginButton"
                        class="w-full bg-gray-800 text-white font-semibold py-2.5 rounded-lg hover:bg-gray-900 transition flex items-center justify-center">
                    <span class="btn-content">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </span>
                </button>
            </form>

            <p class="mt-6 text-sm text-center text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Créer un compte</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });

            // Form submission with loading state
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const buttonContent = loginButton.querySelector('.btn-content');

            loginForm.addEventListener('submit', function() {
                // Disable the button
                loginButton.disabled = true;
                // Add loading class
                loginButton.classList.add('btn-loading');
                // Update button content
                buttonContent.innerHTML = `
                    <span class="spinner"></span>
                    Connexion en cours...
                `;
            });
        });
    </script>
</body>
</html>
