@extends('layouts.page', ['body_class' => 'page-catalog'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')
    <div class="container">
        <div class="row">
            @foreach($list as $offer)
            <div class="col-4">
                <div class="offer-box">
                    <a href="{{ route('offer.show', $offer->slug) }}">
                        <img src="{{ asset('/uploads/offer/'.$offer->file_thumb) }}" alt="{{$offer->title}}">
                    </a>
                    <h2><a href="{{ route('offer.show', $offer->slug) }}">{{$offer->title}}</a></h2>
                    <p>{{$offer->content_entry}}</p>
                    <div class="offer-box-footer d-flex justify-content-end">
                        <a href="{{ route('offer.show', $offer->slug) }}" class="bttn bttn-sm">@lang('cms.zobacz-button')</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
