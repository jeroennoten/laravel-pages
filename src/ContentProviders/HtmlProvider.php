<?php


namespace JeroenNoten\LaravelPages\ContentProviders;


use JeroenNoten\LaravelPages\Models\Content;

class HtmlProvider implements ContentProvider
{

    public function provides()
    {
        return ['html'];
    }

    public function getContent(Content $content)
    {
        $location = $this->normalizeName($content->value);
        $path = implode(DIRECTORY_SEPARATOR, ['pages', 'html', "$location.html"]);
        return file_get_contents(storage_path($path));
    }

    public function render($content)
    {
        return $content;
    }

    public function editorView($type)
    {
        return 'pages::admin.editors.html';
    }

    private function normalizeName($value)
    {
        return str_replace('.', DIRECTORY_SEPARATOR, $value);
    }

    public function updateContent(Content $content, $data)
    {
        $dir = dirname($this->getPath($content));
        if (! file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($this->getPath($content), $data);
    }

    private function getPath(Content $content)
    {
        $location = $this->normalizeName($this->value($content));
        return storage_path(implode(DIRECTORY_SEPARATOR, ['pages', 'html', "$location.html"]));
    }

    private function value(Content $content)
    {
        if (! isset($content->value)) {
            $content->value = uniqid();
        }
        return $content->value;
    }
}