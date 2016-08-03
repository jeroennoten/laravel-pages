<?php


namespace JeroenNoten\LaravelPages\Models;


use Illuminate\Database\Eloquent\Model;
use JeroenNoten\LaravelPages\ContentProviders\ContentProviders;

/**
 * @property mixed type
 * @property mixed value
 * @property mixed section
 * @property mixed content
 * @property mixed viewId
 * @property View view
 * @property mixed id
 */
class Content extends Model
{
    protected $fillable = ['section', 'type', 'content', 'value'];

    protected $appends = ['content'];

    public static function boot()
    {
        parent::boot();

        static::saving(function (Content $content) {
            if (isset($content->attributes['content'])) {
                $content->getContentProvider()->updateContent($content, $content->attributes['content']);
                unset($content->attributes['content']);
            }
        });
    }

    public function view()
    {
        return $this->belongsTo(View::class);
    }

    public function getContentAttribute()
    {
        if (!isset($this->attributes['content'])) {
            $this->attributes['content'] = $this->getContentProvider()->getContent($this);
        }
        return $this->attributes['content'];
    }

    public function getViewIdAttribute()
    {
        return $this->attributes['view_id'];
    }

    public function render()
    {
        return $this->getContentProvider()->render($this->content);
    }

    private function getContentProvider()
    {
        return ContentProviders::get($this->type);
    }
}