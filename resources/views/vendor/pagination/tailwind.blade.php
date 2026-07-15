@if ($paginator->hasPages())

<div class="flex justify-center items-center gap-2 mt-6">

    {{-- Previous --}}

    @if ($paginator->onFirstPage())

        <span
            class="px-3 py-2 rounded bg-gray-200 text-gray-400 cursor-not-allowed">

            &laquo;

        </span>

    @else

        <a
            href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300">

            &laquo;

        </a>

    @endif

    {{-- Nomor Halaman --}}

@php
    $start = max($paginator->currentPage() - 1, 1);
    $end = min($start + 2, $paginator->lastPage());

    if (($end - $start) < 2) {
        $start = max($end - 2, 1);
    }
@endphp

@for ($page = $start; $page <= $end; $page++)

    @if ($page == $paginator->currentPage())

        <span class="px-4 py-2 rounded bg-green-600 text-white">
            {{ $page }}
        </span>

    @else

        <a href="{{ $paginator->url($page) }}"
            class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
            {{ $page }}
        </a>

    @endif

@endfor

    {{-- Next --}}

    @if ($paginator->hasMorePages())

        <a
            href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-2 rounded bg-gray-200 hover:bg-gray-300">

            &raquo;

        </a>

    @else

        <span
            class="px-3 py-2 rounded bg-gray-200 text-gray-400 cursor-not-allowed">

            &raquo;

        </span>

    @endif

</div>

@endif