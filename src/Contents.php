<?php


namespace JeroenNoten\LaravelPages;


class Contents
{
    private $providers = [];

    public function registerProvider(ContentProvider $provider)
    {
        foreach ($provider->provides() as $type) {
            $this->providers[$type] = $provider;
        }
    }

    public function getByPage(Page $page)
    {
        $sections = $page->contents->reduce(function (array $contents, Content $content) {
            if (!isset($contents[$content->section])) {
                $contents[$content->section] = '';
            }
            $contents[$content->section] .= $this->getByContent($content);
            return $contents;
        }, []);
        return $sections;
    }

    private function getByContent(Content $content): string
    {
        $provider = $this->getProvider($content->type);
        return $provider->getContent($content->type, $content->value);
    }

    private function getProvider(string $type): ContentProvider
    {
        return $this->providers[$type];
    }
}