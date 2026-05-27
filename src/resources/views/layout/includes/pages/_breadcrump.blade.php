<!-- Page Title Start -->
<div class="flex items-center md:justify-between flex-wrap gap-2 mb-4 print:hidden">
    <h4 class="text-default-900 text-lg font-semibold">{{ $title  }}</h4>

    <div class="md:flex hidden items-center gap-2 text-sm font-semibold">
        @foreach($links as $link)
        <a href="{{ route($link['route'], $link['params'] ?? []) }}" class="text-sm font-medium text-default-700">{{ $link['name'] }}</a>
        @if(!$loop->last)
        <i class="iconify tabler--chevron-right text-sm flex-shrink-0 text-default-500 rtl:rotate-180"></i>
        @endif
        @endforeach
    </div>
</div>
<!-- Page Title End -->
