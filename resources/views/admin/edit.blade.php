@extends('pages::admin.layouts.master')

@section('title', 'Pagina bewerken')

@section('content_header')
    <p>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-primary">
            <i class="fa fa-arrow-left"></i> Terug
        </a>
    </p>
    <h1>Pagina bewerken</h1>
@endsection

@section('content')
    <page-editor :page="{{ json_encode($page) }}"></page-editor>

@endsection

@section('js')
    @ckeditor
    <script src="{{ asset('vendor/pages/js/app.js') }}"></script>
@append
