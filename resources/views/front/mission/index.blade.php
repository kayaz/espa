@extends('layouts.page', ['body_class' => 'page-mission'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {!! parse_text($page->content) !!}
        </div>
    </div>
</div>
@endsection
