@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.url.edit'))
        <form method="POST" action="{{route('admin.url.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
        <form method="POST" action="{{route('admin.url.store')}}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="container">
                <div class="card">
                    <div class="card-head container">
                        <div class="row">
                            <div class="col-12 pl-0">
                                <h4 class="page-title"><i class="fe-file-text"></i><a href="{{route('admin.page.index')}}" class="p-0">Menu</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.back-route-button')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(!Request::get('lang'))
                                    @include('form-elements.html-select', ['label' => 'Status', 'name' => 'active', 'selected' => $entry->active, 'select' => ['1' => 'Pokaż na liście', '0' => 'Ukryj na liście']])
                                    @include('form-elements.html-select', ['label' => 'Okno docelowe', 'name' => 'url_target', 'selected' => $entry->url_target, 'select' => ['_self' => 'Ta samo okno', '_blank' => 'Nowe okno', '_domain' => 'Link w domenie']])
                                    @include('form-elements.html-input-text', ['label' => 'Adres url', 'sublabel'=> 'Zew. linki, moduł strony', 'name' => 'url', 'value' => $entry->url])

                                    @if($selectMenu->count() > 0)
                                        @include('form-elements.html-select', [
                                            'label' => 'Podstrona',
                                            'name' => 'parent_id',
                                            'selected' => $entry->parent_id,
                                            'select' => $selectMenu
                                        ])
                                    @endif
                                @endif

                                @include('form-elements.html-input-text', ['label' => 'Tytuł strony', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                                @include('form-elements.html-input-text', ['label' => 'Nagłówek H1', 'name' => 'content_header', 'value' => $entry->content_header])
                                @include('form-elements.html-input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                                @include('form-elements.html-input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                                @if(!Request::get('lang'))
                                    @include('form-elements.html-input-text', ['label' => 'Indeksowanie', 'sublabel'=> 'Meta tag - robots', 'name' => 'meta_robots', 'value' => $entry->meta_robots])
                                    @include('form-elements.html-input-file', ['label' => 'Obrazek nagłówka', 'sublabel' => '(wymiary: '.config('images.page.header_width').'px / '.config('images.page.header_height').'px)', 'name' => 'file', 'file' => $entry->file, 'file_preview' => config('images.page.file_path')])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="lang" value="{{$current_locale}}">
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
