<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Manufacture;
use App\Attribute;
use DB;
class SearchController extends Controller
{
	public function search(){
		$cateogries = Category::latest()->get();
		$manufactures = Manufacture::latest()->get();
		$attributes = Attribute::latest()->get();


		return view('search',compact('cateogries','manufactures','attributes'));
	}
	public function search_result(Request $request){

		$inputs = $request->all();

		$cateogries = Category::latest()->get();
		$manufactures = Manufacture::latest()->get();

		//$products = Product::with('categories','manufactures')->get();// eager loading


		
		
		 $products =	Product::with('categories','manufactures')->orderBy('products.id', 'desc');
		
	 	//$products = (new Product)->newQuery();
		

		if($request->input('category_id')){
			$products->whereHas('categories',function ($query) use ($request) {
				$query->where('category_id',$request->input('category_id'));
			});
		}
		if($request->input('manufacture_id')){
			$products->whereHas('manufactures',function ($query) use ($request) {
				$query->whereIn('manufature_id',$request->input('manufacture_id'));
			});
		}


		if($request->input('attribute_id')){
			$products->where('attributes', 'like', '%7%');
		}

		// $data = $products->whereHas('categories', function($query) use($request) {
		// 	$query->where('category_id',  $request->input('category_id'));
		// })->whereHas('manufactures', function($query) use($request) {
		// 	$query->orWhere('manufature_id',  $request->input('manufacture_id'));
		// })
		// ->get();


		// $products = Product::whereHas('category', function($query) use($term) {
		// 	$query->where('category_name', 'like', '%'.$term.'%');
		// })->orWhere('product_name','LIKE','%'.$term.'%')->orderBy($order, 'asc')->get();

		return ($products->get()) ;exit;
		return view('search',compact('cateogries','manufactures','products'));
	}

}
