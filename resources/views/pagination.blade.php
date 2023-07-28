<style>
    .pagination-area .page-item {
    margin: 0 5px;
    }

    .pagination-area .page-item:first-child {
    margin-left: 0;
    }

    .pagination-area .page-item:first-child .page-link {
    border-top-left-radius: 50%;
    border-bottom-left-radius: 50%;
    }

    .pagination-area .page-item:last-child .page-link {
    border-top-right-radius: 50%;
    border-bottom-right-radius: 50%;
    }

    .pagination-area .page-item.active .page-link, .pagination-area .page-item:hover .page-link {
    color: #fff;
    background: #F15412;
    }

    .pagination-area .page-link {
    border: 0;
    padding: 0 10px;
    -webkit-box-shadow: none;
            box-shadow: none;
    outline: 0;
    width: 34px;
    height: 34px;
    display: block;
    border-radius: 4px;
    color: #696969;
    line-height: 34px;
    text-align: center;
    font-weight: 700;
    }

    .pagination-area .page-link.dot {
    background-color: transparent;
    color: #4f5d77;
    letter-spacing: 2px;
    }
</style>

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <ul class="pagination justify-content-start">
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <li class="page-item"><div class="page-link" wire:click = "previousPage"><i class="fi-rs-angle-double-small-left"></i></div></li>
                    @endif

                @foreach ($elements as $element)
                    @if (is_string($element))

                        <li class="page-item active"><div class="page-link">{{$element}}</div></li>

                    @elseif (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><div class="page-link" wire:click = "gotoPage({{$page}})">{{$page}}</div></li>
                            @else
                                <li class="page-item"><div class="page-link" wire:click = "gotoPage({{$page}})">{{$page}}</div></li>
                            @endif
                        @endforeach
                    @endif

                @endforeach
                    {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item"><div class="page-link" wire:click = "nextPage"><i class="fi-rs-angle-double-small-right"></i></div></li>
                        @endif
            </ul>
        </nav>
    @endif
</div>
