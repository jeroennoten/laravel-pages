<?php


namespace JeroenNoten\LaravelPages;


interface ContentProvider
{
    public function provides(): array;

    public function getContent(string $type, string $value): string;
}