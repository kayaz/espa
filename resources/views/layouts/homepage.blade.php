<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ settings()->get("page_title") }}</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ settings()->get("page_description") }}">
    <meta name="robots" content="{{ settings()->get("page_robots") }}">
    <meta name="author" content="{{ settings()->get("page_author") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/styles.min.css') }}" rel="stylesheet">

    @stack('style')
</head>
<body class="homepage">
@include('layouts.partials.header')

<div id="mainSlider">
    <div class="apla">
        <h2>TOOLS AND EQUIPMENT FOR COMPANIES PRODUCING WIRE HARNESSES</h2>
    </div>
    <div class="cover"></div>
    <video autoplay muted controls disablePictureInPicture controlsList="nodownload" poster="{{ asset('/images/poster.jpg') }}" id="videobg">
        <source src="http://www.espa.com.pl/assets/movie.mp4" type="video/mp4">
    </video>
</div>

<div id="mainAbout">
    <div class="container">
        <div class="row inline inline-tc">
            <div class="col-6 d-flex align-items-center">
                <div class="section-text pe-5">
                    <span class="section-subtitle" data-modaleditor="1">{{ getInline($array, 1, 'modaleditor') }}</span>
                    <h2 class="section-title" data-modaltytul="1">{{ getInline($array, 1, 'modaltytul') }}</h2>
                    <div data-modaleditortext="1">{!! getInline($array, 1, 'modaleditortext') !!}</div>
                    <a href="{{ route('about.index') }}" class="bttn mt-3">@lang('cms.wiecejonas-button')</a>
                </div>
            </div>
            <div class="col-6">
                <div class="section-img section-img-shadow">
                    <img src="{{ getInline($array, 1, 'file') }}" alt="{{ getInline($array, 1, 'file_alt') }}" data-img="1">
                </div>
            </div>
            @auth
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="1" data-hideinput="modallink,modallinkbutton" data-method="update" data-imgwidth="800" data-imgheight="600"></button></div>
            @endauth
        </div>
    </div>
</div>

<div id="mainCategory">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            @foreach($boxes as $box)
            <div class="col-{{$box_grid}}">
                <div class="category-box text-center" style="background-image:url('{{ asset('/uploads/boxes/'.$box->file) }}')">
                    <h2 class="section-title"><a href="{{$box->link}}">{{$box->title}}</a></h2>
                    <p>{{$box->text}}</p>
                    <a href="{{$box->link}}" class="bttn mt-3">{{$box->link_button}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="ourClients">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-center">@lang('cms.nasiklienci-header')</h2>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="row d-flex justify-content-center">
                    @foreach($clients as $client)
                        <div class="col-3">
                            <div class="client">
                                <div class="client-box">
                                    <img src="{{ asset('/uploads/clients/'.$client->file) }}" alt="{{ $client->name }} logo">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mainPartnership">
    <div class="container">
        <div class="row inline inline-tc">
            <div class="col-6 d-flex align-items-center">
                <div class="section-text pe-5">
                    <span class="section-subtitle" data-modaleditor="2">{{ getInline($array, 2, 'modaleditor') }}</span>
                    <h2 class="section-title" data-modaltytul="2">{{ getInline($array, 2, 'modaltytul') }}</h2>
                    <div data-modaleditortext="2">{!! getInline($array, 2, 'modaleditortext') !!}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="section-img section-img-shadow">
                    <img src="{{ getInline($array, 2, 'file') }}" alt="{{ getInline($array, 2, 'file_alt') }}" data-img="2">
                </div>
            </div>
            @auth
                <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-bs-toggle="modal" data-bs-target="#inlineModal" data-inline="2" data-hideinput="modallink,modallinkbutton" data-method="update" data-imgwidth="800" data-imgheight="600"></button></div>
            @endauth
        </div>
    </div>
</div>

<div id="reference" class="d-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-center">@lang('cms.referencje-header')</h2>
            </div>
        </div>
        <div id="testimonialCarousel" class="row">
            @foreach($testimonials as $entry)
            <div class="col-3">
                <div class="testimonial">
                    <div class="testimonial-logo">
                        @if($entry->file)<img src="{{ asset('/uploads/testimonials/'.$entry->file) }}" alt="{{$entry->name}} logo">@endif
                    </div>
                    <div class="testimonial-text">
                        <p>{{$entry->text}}</p>
                    </div>
                    <div class="testimonial-author">
                        <p><strong>{{$entry->author}}</strong></p>
                        @if($entry->author_jobposition)<p><i>{{$entry->author_jobposition}}</i></p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="contactBoxes">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="contact-box">
                    <div class="contact-box-circle"><i class="las la-envelope-open-text"></i></div>
                    <h3>@lang('cms.napiszdonas-header')</h3>
                    <p><a href="mailto:espa@espa.com.pl">espa@espa.com.pl</a></p>
                    <a href="mailto:espa@espa.com.pl" class="bttn bttn-sm mt-4">@lang('cms.wyslijwiadomosc-button')</a>
                </div>
            </div>
            <div class="col-4">
                <div class="contact-box">
                    <div class="contact-box-circle"><i class="las la-phone-alt"></i></div>
                    <h3>@lang('cms.zadzwondonas-header')</h3>
                    <p><a href="tel:+48943120867">+48 94 312 08 67</a></p>
                    <a href="tel:+48943120867" class="bttn bttn-sm mt-4">@lang('cms.zadzwon-button')</a>
                </div>
            </div>
            <div class="col-4">
                <div class="contact-box">
                    <div class="contact-box-circle"><i class="las la-map-marked-alt"></i></div>
                    <h3>@lang('cms.odwiedznas-header')</h3>
                    <p>ul. Klementyny Hoffmanowej 1a <br>78-200 Białogard</p>
                    <a href="https://goo.gl/maps/fbxC9wE36uqtNC59A" class="bttn bttn-sm mt-4" target="_blank">@lang('cms.mapadojazdu-button')</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contact">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2344.9413592026117!2d15.991904516328036!3d54.003816432960335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47004b1543d97ef5%3A0x881e9b091b6e2573!2sP.P.U.%20%22eSPa%22%20Pawe%C5%82%20Szumski!5e0!3m2!1spl!2spl!4v1657457330630!5m2!1spl!2spl" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-3 d-flex align-items-center">
                <div class="contact-text">
                    {!! parse_text($contact->content) !!}
                </div>
            </div>
            <div class="col-3">
                <img src="{{ asset('/images/contact.jpg') }}" alt="P.P.U. eSPa">
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.footer')

@include('layouts.partials.cookies')

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/slick.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/app.min.js') }}" charset="utf-8"></script>

@auth
    @include('layouts.partials.inline')
@endauth

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('#testimonialCarousel').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false
        });
    });
</script>
</body>
</html>
