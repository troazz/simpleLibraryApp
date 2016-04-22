<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function writers()
    {
        return $this->belongsToMany('App\Writer');
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Keyword');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = $this->attributesToArray();
        $attributes = array_merge($attributes, $this->relationsToArray());
        unset($attributes['pivot']['created_at']);
        return $attributes;
    }
}
?>