<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Manufacture;
use Validate;
use App\Attribute;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CategoryRequest;
class ProductsController extends Controller
{
	

	public function product_add()
	{ 
		$categories = Category::latest()->get();
		$manufactures = Manufacture::latest()->get();
		$products =Product::latest()->get();	
		$attributes =Attribute::latest()->get();	

		return view('product_add',compact('categories','manufactures','products','attributes'));  
	}

	public function productcreate(ProductRequest $request)
	{ 

		$product = Product::create($request->all());		
		$category = Category::find($request->input('category_id'));
		$product->categories()->attach($category);
		return redirect('products')->withInput();	
	}


	


	public function getProduct($id=null){ exit;
		$product = Product::find($id);
		$categories = Category::latest()->get();
		$manufactures = Manufacture::latest()->get();
		return view('product_edit',compact('product','manufactures','categories')); 
	}

	public function product_update(ProductRequest $request)
	{ 

		$product = Product::find($request->id)->update($request->all());;
		$category = Category::find($request->input('category_id'));
		$syc= Product::find($request->id);		
		$syc->categories()->sync($category);
		return redirect('products')->withInput();	
	}

	public function categoryList(){

		$categories = Category::where('parent_id', '=', 0)->get();
		$allCategories = Category::pluck('category_name','id')->all();		
		return view('create',compact('categories','allCategories'));  
	}



	public function createCategory(CategoryRequest $request){
		
		Category::create($request->all());
		$request->session()->flash('msg', 'Record successfully added!');
		return redirect('categories')->withInput();	
	}

	public function getCategory($id=null){
		$category = Category::find($id);
		return view('category_edit',compact('category')); 
	}

	public function category_update(CategoryRequest $request){

		Category::find($request->input('id'))->update($request->all());
		$request->session()->flash('msg', 'Record successfully updated!');
		return redirect('categories');	

	}



	public function show(Product $product)
	{

		return view('show', compact('product'));    

	}



	public function category_delete($id)
	{
		$category = Category::find($id);
		$category->delete();
		return redirect('categories');	
	}
	public function removeCategory(Product $product)
	{
		$category = Category::find(3);
		$product->categories()->detach($category);
		return 'Success';
	}

}
