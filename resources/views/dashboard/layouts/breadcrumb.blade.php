<div class="container page-title d-flex flex-column justify-content-center flex-wrap me-3 mt-12 mb-3 mx-10">
    @if(isset($page_title))
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        {{ $page_title }}
    </h1>
    @endif
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        @if(isset($links))
            @foreach($links as $key => $link)
                <li class="breadcrumb-item text-muted">
                    <a href="{{$key}}" class="text-muted">{{$link}}</a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
