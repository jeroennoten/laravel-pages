<?php


namespace JeroenNoten\LaravelPages;


use Illuminate\Database\QueryException;

class Pages
{
    public function all()
    {
        try {
            return Page::all();
        } catch (QueryException $e) {
            return [];
        }
    }

    /**
     * @param $uri
     * @return Page
     */
    public function getByUri($uri)
    {
        return Page::where('uri', $uri)->first();
    }
}