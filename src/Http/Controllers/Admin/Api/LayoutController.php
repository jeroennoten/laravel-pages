<?php

namespace JeroenNoten\LaravelPages\Http\Controllers\Admin\Api;


use Illuminate\Routing\Controller;
use JeroenNoten\LaravelPages\Models\Layout;

class LayoutController extends Controller {

    public function show($view)
    {
        return Layout::byView($view);
    }

}