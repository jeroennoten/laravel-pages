<?php


namespace JeroenNoten\LaravelPages\ContentProviders;


class ContentProviders
{
    private static $providers = [];

    public static function register(ContentProvider $provider)
    {
        foreach ($provider->provides() as $type) {
            self::$providers[$type] = $provider;
        }
    }

    /**
     * @param string $type
     * @return ContentProvider
     */
    public static function get($type)
    {
        return self::$providers[$type];
    }
}