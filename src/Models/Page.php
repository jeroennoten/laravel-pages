<?php


namespace JeroenNoten\LaravelPages\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Page find($id)
 * @property string layout
 * @property Collection contents
 * @property View view
 * @property mixed title
 * @property mixed uri
 * @property bool active
 */
class Page extends Model
{
    protected $fillable = ['uri', 'active'];

    public static function make($uri = '/')
    {
        return new static(['uri' => $uri]);
    }

    public function view()
    {
        return $this->belongsTo(View::class);
    }

    public function getTitleAttribute()
    {
        return $this->view->title;
    }

    public function setUriAttribute($value)
    {
        $uri = trim($value, '/');
        $this->attributes['uri'] = $uri ?: '/';
    }

    public function sectionContents($sectionId)
    {
        return $this->view->sectionContents($sectionId);
    }

    public function render()
    {
        return $this->view->render();
    }

    public function updateContents($contents)
    {
        $this->view->updateContents($contents);
    }

    public function delete()
    {
        $this->view->delete();
        parent::delete();
    }

    public function updatePage(array $input)
    {
        $this->update(['active' => (boolean)$input['active']]);
        $this->updateContents($input['view']['contents']);
    }
}