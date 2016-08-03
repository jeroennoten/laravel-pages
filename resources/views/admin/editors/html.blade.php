<textarea name="{{ $name }}"
          class="form-control"
          id="content{{ $contentId }}Field"
>{{ old("contents[$contentId]", $content) }}</textarea>

@section('js')
    @ckeditor("content{$contentId}Field")
@append