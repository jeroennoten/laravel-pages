<?php


namespace JeroenNoten\LaravelPages\Models;


class Layout
{
    public $sections;
    public $view;
    public $name;

    public function __construct($view, $config)
    {
        $this->view = $view;
        $this->name = $config['name'];
        $this->sections = collect($config['sections'])->map(function ($config, $sectionId) {
            return new Section($sectionId, $config);
        });
    }

    public static function all()
    {
        return collect(self::views())->map(function ($config, $view) {
            return new static($view, $config);
        });
    }

    private static function config()
    {
        return config('pages');
    }

    private static function views()
    {
        return self::config()['views'];
    }

    private static function masters()
    {
        return self::config()['masters'];
    }

    public static function byView($view)
    {
        return new static($view, self::views()[$view]);
    }

    public static function default()
    {
        return self::byView(self::masters()[0]);
    }

    public function __toString()
    {
        return json_encode($this);
    }
}