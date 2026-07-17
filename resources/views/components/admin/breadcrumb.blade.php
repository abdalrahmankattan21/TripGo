@props(['items' => []])

<nav class="flex items-center space-x-1 text-sm text-gray-500">
    @foreach ($items as $item)
        @if (!$loop->last && !empty($item['url']))
            <a href="{{ $item['url'] }}" class="hover:text-gray-900 hover:underline">{{ $item['label'] }}</a>
            <span>/</span>
        @else
            <span class="text-gray-900">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
