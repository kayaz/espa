@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.testimonial.edit'))
        <form method="POST" action="{{route('admin.testimonial.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.testimonial.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title"><i class="fe-message-square"></i><a href="{{route('admin.testimonial.index')}}" class="p-0">Referencje</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-input-text-count', ['label' => 'Nazwa klienta', 'name' => 'name', 'value' => $entry->name, 'maxlength' => 255, 'required' => 1])
                                        @include('form-elements.html-input-text-count', ['label' => 'Tekst', 'name' => 'text', 'value' => $entry->text, 'maxlength' => 110, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Osoba', 'name' => 'author', 'value' => $entry->author, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Pozycja w firmie', 'name' => 'author_jobposition', 'value' => $entry->author_jobposition, 'required' => 1])
                                        @include('form-elements.html-input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.config('images.testimonial.width').'px / '.config('images.testimonial.height').'px)', 'name' => 'file', 'file' => $entry->file, 'file_preview' => config('images.testimonial.preview_file_path')])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @endsection
