@extends('layouts.page', ['body_class' => 'page-catalog-show'])

@section('meta_title', $offer->title)

@section('pageheader')
    @include('layouts.partials.offer-header', ['page' => $page, 'offer' => $offer])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside>
                    <nav>
                        <ul id="sidemenu" class="mb-0 list-unstyled">
                            @foreach($list as $offerMenu)
                            <li @if($offer->slug == $offerMenu->slug) class="active"@endif>
                                <a href="{{ route('offer.show', $offerMenu->slug) }}">
                                    <i class="las la-angle-double-right"></i> {{ $offerMenu->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                    <div id="contactBoxes">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="contact-box">
                                        <div class="contact-box-circle"><i class="las la-envelope-open-text"></i></div>
                                        <h3>@lang('cms.napiszdonas-header')</h3>
                                        <p><a href="mailto:espa@espa.com.pl">espa@espa.com.pl</a></p>
                                        <a href="mailto:espa@espa.com.pl" class="bttn bttn-sm mt-4">@lang('cms.wyslijwiadomosc-button')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-9">
                {!! parse_text($offer->content) !!}
            </div>
        </div>
    </div>
@endsection
