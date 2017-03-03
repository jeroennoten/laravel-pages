<?php


namespace JeroenNoten\LaravelPages\ContentProviders;



use JeroenNoten\LaravelPages\Models\Content;

class StringProvider implements ContentProvider
{
    public function provides()
    {
        return ['string'];
    }

    public function getContent(Content $content)
    {
        return $content->value;
    }

    public function render($content)
    {
        return e($content);
    }

    public function editorView($type)
    {
        return 'pages::admin.editors.string';
    }

    public function updateContent(Content $content, $data)
    {
        $content->value = $data ?: '';
    }
}