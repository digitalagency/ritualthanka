<ul class="pagination">
   {{-- <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1"><i class="fa fa-angle-double-left"></i></a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item">
        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item">
        <a class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a>
    </li>--}}


    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a href="" class="page-link"><span>&laquo;</span></a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

                <!-- Pagination Elements -->
        @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li class="page-item disabled"><a class="page-link" href="#"><span>{{ $element }}</span></a></li>
            @endif

                    <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="#"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                                <!-- Next Page Link -->
                        @if ($paginator->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><a href="" class="page-link"><span>&raquo;</span></a></li>
                        @endif



</ul>