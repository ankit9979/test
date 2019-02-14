<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Category extends Model
{
	protected $fillable = ['category_name','parent_id']; 
	public function products()
	{
		return $this->belongsToMany(Product::class);
	}

	public function childs() {
		return $this->hasMany('App\Category','parent_id','id') ;
	}
}
