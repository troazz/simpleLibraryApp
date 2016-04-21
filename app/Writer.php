<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
?>