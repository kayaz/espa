@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.box.edit'))
        <form method="POST" action="{{route('admin.box.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
        <form method="POST" action="{{route('admin.box.store')}}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="container">
                <div class="card">
                    <div class="card-head container">
                        <div class="row">
                            <div class="col-12 pl-0">
                                <h4 class="page-title"><i class="fe-grid"></i><a href="{{route('admin.box.index')}}" class="p-0">Boksy z obrazkami</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.back-route-button')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('form-elements.html-input-text-count', ['label' => 'Nazwa', 'name' => 'title', 'value' => $entry->title, 'maxlength' => 255, 'required' => 1])
                                @include('form-elements.html-input-text-count', ['label' => 'Tekst', 'name' => 'text', 'value' => $entry->text, 'maxlength' => 255, 'required' => 1])

                                @if(!Request::get('lang'))
                                    @include('form-elements.html-input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.config('images.box.width').'px / '.config('images.box.height').'px)', 'name' => 'file', 'file' => $entry->file, 'file_preview' => config('images.box.preview_file_path')])
                                @endif

                                @include('form-elements.html-input-text-count', ['label' => 'Atrybut ALT zdjęcia', 'name' => 'file_alt', 'value' => $entry->file_alt, 'maxlength' => 100])
                                @include('form-elements.html-input-text', ['label' => 'CTA link', 'name' => 'link', 'value' => $entry->link, 'required' => 1])
                                @include('form-elements.html-input-text', ['label' => 'CTA button', 'name' => 'link_button', 'value' => $entry->link_button, 'required' => 1])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="lang" value="{{$current_locale}}">
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
