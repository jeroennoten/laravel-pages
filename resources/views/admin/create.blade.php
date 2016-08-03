@extends('pages::admin.layouts.master')

@section('title', 'Nieuwe pagina')

@section('content_header')
    <p>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-primary">
            <i class="fa fa-arrow-left"></i> Terug
        </a>
    </p>
    <h1>Nieuwe pagina</h1>
@endsection

@section('content')
    <form method="post" action="{{ route('admin.pages.store') }}">
        {{ csrf_field() }}
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Nieuwe pagina aanmaken</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label" for="uriField">Uri</label>
                    <input type="text" name="uri" value="/" class="form-control" id="uriField">
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">Pagina aanmaken</button>
            </div>
        </div>
    </form>
@endsection
