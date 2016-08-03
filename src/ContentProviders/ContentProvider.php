<?php


namespace JeroenNoten\LaravelPages\ContentProviders;


use JeroenNoten\LaravelPages\Models\Content;

interface ContentProvider
{
    public function provides();

    public function getContent(Content $content);

    public function updateContent(Content $content, $data);

    public function editorView($type);

    public function render($content);
}