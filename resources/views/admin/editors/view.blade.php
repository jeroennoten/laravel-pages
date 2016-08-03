@if($contentId)
    <input type="hidden"
           name="{{ $name }}[id]"
           value="{{ $content->id }}"
    >
@endif
<div class="box box-primary">
    @if($content->layoutName)
        <div class="box-header with-border">
            <h3 class="box-title">{{ $content->layoutName }}</h3>
        </div>
    @endif
    <div class="box-body">
        @foreach($content->sections as $section)
            <div class="form-group">
                @if(isset($section->name))
                    <label>{{ $section->name }}</label>
                @endif
                @foreach($content->sectionContents($section) as $sectionContent)
                    @include("pages::admin.editors.$sectionContent->type", [
                    'contentId' => $sectionContent->id,
                    'content' => $sectionContent->content,
                    'config' => $section->types[$sectionContent->type]->config,
                    'name' => $name . "[contents][$sectionContent->id]"
                    ])
                @endforeach
                @foreach($section->types as $contentType)
                    @include('pages::admin.editors.' . $contentType->id, [
                    'content' => null,
                    'contentId' => null,
                    'name' => $name . "[new][]",
                    'config' => $contentType->config,
                    ])
                @endforeach
                <p>
                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Toevoegen</button>
                </p>
            </div>
        @endforeach
    </div>
</div>
