<?php


namespace JeroenNoten\LaravelPages;


class StringProvider implements ContentProvider
{
    public function provides(): array
    {
        return ['string'];
    }

    public function getContent(string $type, string $value): string
    {
        return htmlentities($value);
    }
}