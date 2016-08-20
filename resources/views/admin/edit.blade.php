@extends('pages::admin.layouts.master')

@section('title', 'Pagina bewerken')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@append

@section('content_header')
    <p>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-primary">
            <i class="fa fa-arrow-left"></i> Terug
        </a>
        <button type="button" class="btn btn-xs btn-danger page-delete-button">
            <i class="fa fa-trash"></i> Pagina verwijderen
        </button>
    </p>
    <h1>Pagina bewerken</h1>
@endsection

@section('content')
    <page-editor :page="{{ json_encode($page) }}"></page-editor>
@endsection

@section('js')
    @ckeditor
    <script src="{{ asset('vendor/pages/js/app.js') }}"></script>
    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" id="pageDeleteForm">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
    <script>
        $('.page-delete-button').on('click', function () {
            $('#pageDeleteForm').submit();
        });
    </script>
@append
