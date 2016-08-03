<?php


namespace JeroenNoten\LaravelPages\Models;


class ContentType
{
    public $id;
    public $config;

    public function __construct($id, $config)
    {
        $this->id = $id;
        $this->config = $config;
    }
}