<?php


namespace JeroenNoten\LaravelPages\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static View find($id)
 * @method static View create($attribute)
 * @property Page page
 * @property Layout layout
 * @property Collection contents
 * @property mixed title
 * @property mixed id
 */
class View extends Model
{
    protected $fillable = ['layout'];

    protected $appends = ['layout'];

    public static function make()
    {
        return new static(['layout' => Layout::default()]);
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function getTitleAttribute()
    {
        $content = $this->sectionContents('title')->first();
        return $content ? $content->content : '';
    }

    public function getLayoutAttribute()
    {
        return Layout::byView($this->attributes['layout']);
    }

    public function setLayoutAttribute($layout)
    {
        $this->attributes['layout'] = $layout instanceof Layout ? $layout->view : $layout;
    }

    public function sectionContents($section)
    {
        if ($section instanceof Section) {
            $section = $section->id;
        }
        return $this->contents->where('section', $section);
    }

    public function render()
    {
        return view('pages::view', [
            'layout' => $this->layout->view,
            'contents' => $this->renderContents(),
            'sections' => $this->layout->sections
        ])->render();
    }

    private function renderContents()
    {
        return $this->contents->map(function (Content $content) {
            return [
                'section' => $content->section,
                'html' => $content->render()
            ];
        });
    }

    public function getSectionsAttribute()
    {
        return $this->layout->sections;
    }

    public function getLayoutNameAttribute()
    {
        return $this->layout->name;
    }

    public function updateContents(array $contents)
    {
        $hasId = function ($content) {
            return isset($content['id']);
        };
        $contentsCollection = collect($contents);
        $contentsMap = $contentsCollection->filter($hasId)->keyBy('id');
        $this->contents->each(function (Content $content) use ($contentsMap) {
            if (isset($contentsMap[$content->id])) {
                $content->content = $contentsMap[$content->id]['content'];
                $content->save();
            } else {
                $content->delete();
            }
        });
        $this->contents()->saveMany($contentsCollection->reject($hasId)->map(function ($content) {
            return new Content($content);
        }));
    }
}