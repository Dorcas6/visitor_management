@if ($success = session()->pull('success'))
    <div class="relative alert alert-success mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-600 text-green-800 dark:text-green-100 border border-green-200 dark:border-green-800">
        <button type="button" class="absolute top-2 right-2 text-xl leading-none text-green-800 dark:text-green-100 hover:text-green-600" onclick="this.parentElement.remove()">
            &times;
        </button>
        {{ $success }}
    </div>
@endif

@if ($error = session()->pull('error'))
    <div class="relative alert alert-error mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-600 text-red-800 dark:text-red-100 border border-red-200 dark:border-red-800">
        <button type="button" class="absolute top-2 right-2 text-xl leading-none text-red-800 dark:text-red-100 hover:text-red-600" onclick="this.parentElement.remove()">
            &times;
        </button>
        {{ $error }}
    </div>
@endif

@if ($warning = session()->pull('warning'))
    <div class="relative alert alert-warning mb-4 p-4 rounded-lg bg-yellow-100 dark:bg-yellow-600 text-yellow-800 dark:text-yellow-100 border border-yellow-200 dark:border-yellow-800">
        <button type="button" class="absolute top-2 right-2 text-xl leading-none text-yellow-800 dark:text-yellow-100 hover:text-yellow-600" onclick="this.parentElement.remove()">
            &times;
        </button>
        {{ $warning }}
    </div>
@endif

@if ($info = session()->pull('info'))
    <div class="relative alert alert-info mb-4 p-4 rounded-lg bg-blue-100 dark:bg-blue-600 text-blue-800 dark:text-blue-100 border border-blue-200 dark:border-blue-800">
        <button type="button" class="absolute top-2 right-2 text-xl leading-none text-blue-800 dark:text-blue-100 hover:text-blue-600" onclick="this.parentElement.remove()">
            &times;
        </button>
        {{ $info }}
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="relative alert alert-error mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-600 text-red-800 dark:text-red-100 border border-red-200 dark:border-red-800">
            <button type="button" class="absolute top-2 right-2 text-xl leading-none text-red-800 dark:text-red-100 hover:text-red-600" onclick="this.parentElement.remove()">
                &times;
            </button>
            {{ $error }}
        </div>
    @endforeach
@endif
