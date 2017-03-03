<?php


namespace JeroenNoten\LaravelPages\ContentProviders;


class ContentProviders
{
    private $providers = [];
    /**
     * @var array
     */
    private $customTypes;

    public function __construct(array $customTypes = [])
    {
        $this->customTypes = $customTypes;
    }

    public function register(ContentProvider $provider)
    {
        foreach ($provider->provides() as $type) {
            $this->providers[$type] = $provider;
        }
    }

    /**
     * @param string $type
     * @return ContentProvider
     */
    public function get($type)
    {
        if (isset($this->customTypes[$type])) {
            $type = $this->customTypes[$type];
        }

        return $this->providers[$type];
    }
}