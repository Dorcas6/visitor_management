<header class="bg-gray-800 text-white px-6 py-3 shadow">
    <div class="flex items-center justify-between">
        <!-- Bouton menu mobile -->
        <div class="flex items-center space-x-4">
            <button class="md:hidden text-white" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-lg font-semibold hidden sm:block">Gestion des Visiteurs</h1>
        </div>

        <!-- Informations utilisateur et notifications -->
        <div class="flex items-center space-x-6">
            <!-- Heure actuelle -->
            <div class="hidden md:flex items-center text-sm text-gray-300">
                <i class="far fa-clock mr-2"></i>
                <span id="current-time">{{ now()->format('H:i') }}</span>
                <span class="ml-1">{{ now()->translatedFormat('d F Y') }}</span>
            </div>

            <!-- Bouton notifications -->
            <button class="relative text-gray-300 hover:text-white transition-colors">
                <i class="far fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
            </button>

            <!-- Menu utilisateur -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </button>
                
                <!-- Menu déroulant -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="far fa-user mr-2 text-gray-500"></i> Mon profil
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2 text-gray-500"></i> Paramètres
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Script pour l'heure en temps réel -->
<script>
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
        }
    }
    
    // Mettre à jour l'heure toutes les secondes
    setInterval(updateTime, 60000);
    
    // Mettre à jour immédiatement
    updateTime();
</script>
