<?php

namespace JeroenNoten\LaravelPages\Http\Controllers\Admin\Api;


use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Models\Content;

class ContentController extends Controller {

    public function show(Content $content)
    {
        return $content;
    }

}