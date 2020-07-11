<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'is_active'
    ];


    public function blogCategories()
    {
    	return $this->hasMany('App\BlogCategory');
    }


    public function categories()
    {
    	$categories = BlogCategory::where('blog_id', $this->id)->get();
    	$resp = "";
    	foreach ($categories as $key => $value) {
    		$resp = $value->category->name . ", ". $resp;
    	}    	
    	return $resp;        
    }


}
