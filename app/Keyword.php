<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['name'];

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
?>