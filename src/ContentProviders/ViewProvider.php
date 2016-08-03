<?php


namespace JeroenNoten\LaravelPages\ContentProviders;


use JeroenNoten\LaravelPages\Models\Content;
use JeroenNoten\LaravelPages\Models\View;

/**
 * @property mixed id
 */
class ViewProvider implements ContentProvider
{
    public function provides()
    {
        return ['view'];
    }

    public function getContent(Content $content)
    {
        return View::with('contents')->find($content->value);
    }

    /**
     * @param View $content
     * @return mixed
     */
    public function render($content)
    {
        return $content->render();
    }

    public function editorView($type)
    {
        return 'pages::admin.editors.view';
    }

    public function updateContent(Content $content, $data)
    {
        $this->getView($content, $data['layout']['view'])->updateContents($data['contents']);
    }

    private function getView(Content $content, $layout)
    {
        if (!isset($content->value)) {
            $view = View::create(['layout' => $layout]);
            $content->value = $view->id;
            return $view;
        }
        return View::find($content->value);
    }
}