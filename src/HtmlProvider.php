<?php


namespace JeroenNoten\LaravelPages;


class HtmlProvider implements ContentProvider
{

    public function provides(): array
    {
        return ['html'];
    }

    public function getContent(string $type, string $value): string
    {
        $location = $this->normalizeName($value);
        $path = implode(DIRECTORY_SEPARATOR, ['pages', 'html', "$location.html"]);
        return file_get_contents(storage_path($path));
    }

    private function normalizeName($value)
    {
        return str_replace('.', DIRECTORY_SEPARATOR, $value);
    }
}