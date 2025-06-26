<header class="bg-gray-800 text-white px-6 py-4 shadow flex items-center justify-between">
    <button class="md:hidden text-white" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="text-lg font-semibold">Tableau de bord</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-sm font-medium text-blue-400 hover:text-white flex items-center gap-2">
            <i class="fas fa-sign-out-alt"></i> Se déconnecter
        </button>
    </form>
</header>
