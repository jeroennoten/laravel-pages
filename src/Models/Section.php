<?php


namespace JeroenNoten\LaravelPages\Models;


class Section
{
    public $id;
    public $name;
    public $types;
    public $max;

    public function __construct($id, $config)
    {
        $this->id = $id;
        $this->name = $config['name'] ?? null;
        $this->types = collect($config['contents']['types'])->map(function ($config, $id) {
            if (!is_string($id)) {
                $id = $config;
                $config = [];
            }
            return new ContentType($id, $config);
        })->keyBy('id');
        $this->max = $config['contents']['max'] ?? null;
    }
}