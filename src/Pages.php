<?php


namespace JeroenNoten\LaravelPages;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\QueryException;
use JeroenNoten\LaravelPages\Models\Page;

class Pages
{
    private $pages;

    /**
     * @return Collection
     */
    public function all()
    {
        if (is_null($this->pages)) {
            $this->loadAll();
        }
        return $this->pages;
    }

    /**
     * @return Collection
     */
    public function allWithTitles()
    {
        return $this->all()->load(['view.contents' => function (HasMany $query) {
            $query->where('section', 'title');
        }]);
    }

    public function loadAll()
    {
        try {
            $this->pages = Page::all();
        } catch (QueryException $e) {
            $this->pages = [];
        }
    }

    /**
     * @param $uri
     * @return Page
     */
    public function getByUri($uri)
    {
        /** @var Page $page */
        $page = Page::where('uri', $uri)->first();
        return $page;
    }
}