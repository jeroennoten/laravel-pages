<?php


namespace JeroenNoten\LaravelPages;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @property string layout
 * @property Collection contents
 */
class Page extends Model
{
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}