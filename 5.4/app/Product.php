<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $casts = [
		'attributes' => 'array'
	];

	protected $fillable = ['product_name','product_desc','manufature_id','attributes']; 
	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public function manufactures()
	{
		return $this->belongsTo(Manufacture::class,'manufature_id', 'id');
	}
}
