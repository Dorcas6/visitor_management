@props([
    'title' => null,
    'icon' => 'info-circle',
    'actions' => null,
])

<div class="bg-white shadow-md rounded-2xl overflow-hidden mb-6">
    @if($title || $actions)
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        @if($title)
        <h3 class="text-lg font-medium text-gray-900">
            <i class="fas fa-{{ $icon }} mr-2 text-blue-600"></i>
            {{ $title }}
        </h3>
        @endif
        @if($actions)
        <div class="flex items-center space-x-2">
            {{ $actions }}
        </div>
        @endif
    </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
