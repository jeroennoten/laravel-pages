@extends('pages::admin.layouts.master')

@section('title', 'Pagina\'s')

@section('content_header')
    <h1>Pagina's beheren</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Pagina's</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin table-hover">
                    <thead>
                    <tr>
                        <th>Uri</th>
                        <th>Titel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr style="cursor: pointer;"
                            onclick="location.href = '{{ route('admin.pages.edit', $page) }}';">
                            <td>
                                {{ $page->uri }}
                            </td>
                            <td>
                                {{ $page->title }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">
                <i class="fa fa-file"></i> Nieuwe pagina
            </a>
        </div>
    </div>
@endsection