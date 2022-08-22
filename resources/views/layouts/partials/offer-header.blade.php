<div id="page-header" @if($offer->file_header) style="background: url({{ asset('/uploads/pages/headers/'.$offer->file_header) }}) no-repeat top center" @endif>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <div>
                        <div class="section-header text-center">
                            <span>@include('layouts.partials.breadcrumbs', ['items' => $page->ancestors, 'title' => ($page->content_header) ?: $page->title])</span>
                            <h1>{{ $offer->title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
