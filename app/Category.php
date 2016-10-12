<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    public function parent_category()
    {
    	return $this->belongsTo('App\Category', 'pid', 'id');
    }

    public function sub_categories()
    {
    	return $this->hasMany('App\Category', 'pid', 'id');
    }
}
