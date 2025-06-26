<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cAx4FFnrc+ljYedHI6A1vKKkZ6TKEPSMJoVWjL" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function toggleMenuDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.querySelector(`button[onclick='toggleMenuDropdown("${id}")'] i`);
            
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }
    </script>
    @include("partials._font-awesome")
   </head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    @include("partials._side-bar")

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        @include("partials._header")

        <!-- Main content -->
        <main class="flex-1 p-6 space-y-6">
            <div class="max-w-7xl mx-auto px-4 py-8">
                @include("partials._alerts")
                @yield('content')
            </div>
        </main>

    </div>
</div>

</body>
@yield("script")
</html>
