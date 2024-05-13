@extends('admin.dashboard.index')

@section('dashboard')
    <form method="POST" action="{{route('admin.dashboard.seo.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid p-0">
            <div class="card p-4">
                @if (session('success'))
                    <div class="alert alert-success border-0">
                        {{ session('success') }}
                        <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                    </div>
                @endif
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.html-input-text-count', ['label' => 'Nazwa strony', 'sublabel' => 'Meta tag - title / ilość znaków: 50 - 60', 'name' => 'page_title', 'value' => settings()->get("page_title"), 'maxlength' => 60, 'required' => 1])
                            @include('form-elements.html-input-text-count', ['label' => 'Opis strony', 'sublabel' => 'Meta tag - description / ilość znaków: 120 - 158', 'name' => 'page_description', 'value' => settings()->get("page_description"), 'maxlength' => 158, 'required' => 1])
                            @include('form-elements.input-text', ['label' => 'Adres strony', 'sublabel' => 'URL strony', 'name' => 'page_url', 'value' => settings()->get("page_url"), 'required' => 1])

                            <div class="form-group row">
                                <div class="col-3 col-form-label control-label"></div>
                                <div class="col-4">
                                    <div class="btn btn-primary" id="pagespeed">PageSpeed Insights</div>
                                    <div class="btn btn-primary" id="facebookcrawler">Facebook Crawler</div>
                                </div>
                            </div>

                            @include('form-elements.input-text', ['label' => 'Adres e-mail', 'sublabel' => 'Adres e-mail do formularza kontaktowego', 'name' => 'page_email', 'value' => settings()->get("page_email"), 'required' => 1])

                        </div>
                    </div>

                    <div class="section">
                        <div class="row">
                            <div class="col-12">
                                Podgląd wyszukiwarki Google
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-3 col-form-label control-label">&nbsp;</div>
                                <div class="col-14" style="line-height: normal">
                                    <h3 style="font-family: arial,sans-serif;font-size:18px;line-height: 1.2;margin:0;font-weight: normal;color:#1a0dab;">{{settings()->get("page_title")}}</h3>
                                    <div style="line-height: 14px"><cite style="font-size:14px;line-height: 16px;color: #006621;font-style: normal;font-family: arial,sans-serif">{{settings()->get("page_description")}}</cite></div>
                                    <span style="font-family: arial,sans-serif;font-size:13px;line-height:18px;color: #545454">{{settings()->get("page_url")}}</span>

                                </div>
                            </div>

                            @include('form-elements.input-text', ['label' => 'Autor strony', 'sublabel' => 'Meta tag - author', 'name' => 'page_author', 'value' => settings()->get("page_author")])
                            @include('form-elements.input-text', ['label' => 'Adres e-mail', 'name' => 'page_email', 'value' => settings()->get("page_email")])

                            <div class="form-group row">

                                <label for="page_robots" class="col-3 col-form-label control-label"><div class="text-right">Indeksowanie<br><span>Meta tag - robots</span></div></label>

                                <div class="col-4">
                                    <select id="page_robots" class="form-select" name="page_robots" id="page_robots">
                                        <option value="noindex, nofollow"<?php if(settings()->get("page_robots") == 'noindex, nofollow'){?> selected<?php } ?>>noindex, nofollow</option>
                                        <option value="index, follow"<?php if(settings()->get("page_robots") == 'index, follow'){?> selected<?php } ?>>index, follow</option>
                                        <option value="index, nofollow"<?php if(settings()->get("page_robots") == 'index, nofollow'){?> selected<?php } ?>>index, nofollow</option>
                                        <option value="noindex, follow"<?php if(settings()->get("page_robots") == 'noindex, follow'){?> selected<?php } ?>>noindex, follow</option>
                                    </select>
                                </div>
                            </div>

                            <div class="section">
                                <div class="row">
                                    <div class="col-12">
                                        Dodatkowe ustawienia
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.textarea', ['label' => 'Kod w <code>&lt;head&gt;</code>', 'name' => 'scripts_head', 'value' => settings()->get("scripts_head"), 'rows' => 7])
                            @include('form-elements.textarea', ['label' => 'Kod po otworzeniu <code>&lt;body&gt;</code>', 'name' => 'scripts_afterbody', 'value' => settings()->get("scripts_afterbody"), 'rows' => 7])
                            @include('form-elements.textarea', ['label' => 'Kod przed zamknięciem <code>&lt;body&gt;</code>', 'name' => 'scripts_beforebody', 'value' => settings()->get("scripts_beforebody"), 'rows' => 7])
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-group-submit">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <input name="submit" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $( ".input-url .form-control" ).each(function() {
                if($( this ).val()) {
                    $( this ).next( ".input-group-append" ).removeClass('d-none').addClass('d-block');
                }
            });
            $( ".input-group-append button" ).click(function() {
                const url = $( this ).offsetParent().children('input').val();
                window.open(url, '_blank');
            });
            $('#pagespeed').click(function() {
                const url = $( "#form_page_url" ).val();
                window.open('https://developers.google.com/speed/pagespeed/insights/?url=' + url, '_blank');
            });
        });
    </script>
@endpush
