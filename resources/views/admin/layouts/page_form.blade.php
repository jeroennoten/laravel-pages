@extends('pages::admin.layouts.master')

@section('content_header')
    <p><a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Terug</a></p>
    <h1>
        @yield('page_title')
        <button class="btn btn-success save-button"><i class="fa fa-save"></i> Opslaan</button>
        @yield('delete_button')
    </h1>
@endsection

@section('content')
    <form action="@yield('form_action')" method="post" id="pageForm">
        {{ csrf_field() }}
        @yield('form_start')
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <label>Uri</label>
                    <input type="text"
                           name="uri"
                           value="{{ old('uri', $page->uri) }}"
                           class="form-control"
                    >
                </div>
            </div>
        </div>
        @include('pages::admin.editors.view', [
        'contentId' => null,
        'config' => [],
        'content' => $page->view,
        'name' => 'page'
        ])
    </form>
    <button class="btn btn-success save-button"><i class="fa fa-save"></i> Opslaan</button>
@endsection

@section('js')
    <script>
        $('.save-button').on('click', function () {
            $('#pageForm').submit();
        })
    </script>
@append