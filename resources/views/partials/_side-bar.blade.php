@if(auth('web')->check())
    {{-- Sidebar pour les agents de sécurité --}}
    <aside class="w-64 bg-gray-800 text-white shadow hidden md:block">
        <div class="p-6 font-bold text-xl text-blue-400 border-b border-blue-500">Menu</div>
        <nav class="p-4 space-y-6">
            <div>
                <h4 class="text-xs text-gray-400 uppercase mb-1 flex items-center gap-2">
                    <i class="fas fa-tachometer-alt text-blue-400"></i>
                    Accueil
                </h4>
                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-blue-900 rounded flex items-center gap-3">
                        <i class="fas fa-chart-line text-blue-400"></i>
                        <span>Statistiques</span>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-xs text-gray-400 uppercase mb-1 flex items-center gap-2">
                    <i class="fas fa-users-cog text-blue-400"></i>
                    Gestion
                </h4>
                <div class="space-y-1">
                    <!-- Bouton Agents de sécurité -->
                    <button class="w-full p-2 hover:bg-blue-900 rounded flex items-center gap-3" onclick="toggleMenuDropdown('security')">
                        <i class="fas fa-user-shield text-blue-400"></i>
                        <span>Agents de sécurité</span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </button>
                    <div id="security" class="hidden space-y-1">
                        <a href="{{ route('users.index') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-list text-blue-400"></i>
                            Liste des agents
                        </a>
                        <a href="{{ route('users.create') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-user-plus text-blue-400"></i>
                            Ajouter un agent
                        </a>
                    </div>

                    <!-- Bouton Locataires -->
                    <button class="w-full p-2 hover:bg-blue-900 rounded flex items-center gap-3" onclick="toggleMenuDropdown('tenants')">
                        <i class="fas fa-building text-blue-400"></i>
                        <span>Locataires</span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </button>
                    <div id="tenants" class="hidden space-y-1">
                        <a href="{{ route('tenants.index') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-list text-blue-400"></i>
                            Liste des locataires
                        </a>
                        <a href="{{ route('tenants.create') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-plus-circle text-blue-400"></i>
                            Ajouter un locataire
                        </a>
                    </div>

                    <!-- Bouton Visiteurs -->
                    <button class="w-full p-2 hover:bg-blue-900 rounded flex items-center gap-3" onclick="toggleMenuDropdown('visitors')">
                        <i class="fas fa-user-friends text-blue-400"></i>
                        <span>Visiteurs</span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </button>
                    <div id="visitors" class="hidden space-y-1">
                        <a href="{{ route('visitors.index') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-list text-blue-400"></i>
                            Liste des visiteurs
                        </a>
                        <a href="{{ route('visitors.create') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-plus-circle text-blue-400"></i>
                            Ajouter un visiteur
                        </a>
                    </div>

                    <!-- Bouton Visites -->
                    <button class="w-full p-2 hover:bg-blue-900 rounded flex items-center gap-3" onclick="toggleMenuDropdown('visits')">
                        <i class="fas fa-clipboard-list text-blue-400"></i>
                        <span>Visites</span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </button>
                    <div id="visits" class="hidden space-y-1">
                        <a href="{{ route('visits.index') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-list text-blue-400"></i>
                            Liste des visites
                        </a>
                        <a href="{{ route('visits.create') }}" class="block p-2 pl-6 hover:bg-blue-900 rounded flex items-center gap-3">
                            <i class="fas fa-plus-circle text-blue-400"></i>
                            Nouvelle visite
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </aside>
@elseif(auth('tenants')->check())
    {{-- Sidebar pour les locataires --}}
    <aside class="w-64 bg-gray-800 text-white shadow hidden md:block">
        <div class="p-6 font-bold text-xl text-blue-400 border-b border-blue-500">Menu</div>
        <nav class="p-4 space-y-6">
            <div>
                <h4 class="text-xs text-gray-400 uppercase mb-1 flex items-center gap-2">
                    <i class="fas fa-tachometer-alt text-blue-400"></i>
                    Accueil
                </h4>
                <div class="space-y-1">
                    <a href="{{ route('tenants.dashboard') }}" class="block p-2 hover:bg-blue-900 rounded flex items-center gap-3">
                        <i class="fas fa-chart-line text-blue-400"></i>
                        <span>Statistiques</span>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-xs text-gray-400 uppercase mb-1 flex items-center gap-2">
                    <i class="fas fa-users-cog text-blue-400"></i>
                    Gestion
                </h4>
                <div class="space-y-1">
                    <!-- Bouton Visiteurs -->
                    <a href="{{ route('visitors.index') }}" class="block p-2 hover:bg-blue-900 rounded flex items-center gap-3">
                        <i class="fas fa-user-friends text-blue-400"></i>
                        <span>Visiteurs</span>
                    </a>

                    <!-- Bouton Visites -->
                    <a href="{{ route('visits.index') }}" class="block p-2 hover:bg-blue-900 rounded flex items-center gap-3">
                        <i class="fas fa-clipboard-list text-blue-400"></i>
                        <span>Visites</span>
                    </a>
                </div>
            </div>
        </nav>
    </aside>
@endif
