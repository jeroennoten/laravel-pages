@extends($layout)

@foreach($sections as $section => $content)
    @section("$section", $content)
@endforeach
