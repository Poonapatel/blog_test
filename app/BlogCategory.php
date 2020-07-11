<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'category_id', 'blog_id'
    ];


    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
