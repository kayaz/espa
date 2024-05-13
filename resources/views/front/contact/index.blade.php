@extends('layouts.page', ['body_class' => 'page-contact'])

@section('meta_title', $page->title)

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => $page])
@stop

@section('content')

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
                        {!! parse_text($page->content) !!}
                    </div>
                </div>
                <div class="col-3">
                    <img src="{{ asset('/images/contact.jpg') }}" alt="P.P.U. eSPa">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endpush
