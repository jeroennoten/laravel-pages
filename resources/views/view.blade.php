@extends("$layout")

@foreach($contents as $content)
    @section($content['section']){!! $content['html'] !!}@append
@endforeach
