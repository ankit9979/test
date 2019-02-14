@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif



<form method="POST" action="{{route('product_update')}}">
	{{csrf_field()}}

	<input type="text" name="product_name" value="{{$product->product_name}}" placeholder="product name">  </br>
	<input type="text" name="product_desc" value="{{$product->product_desc}}" placeholder="product desc"></br>
	<select name="manufature_id">
		<option value=" ">Select </option>
		@foreach($manufactures as $manufacture)
		<option value="{{$manufacture->id}}" {{ $manufacture->id === $product->manufature_id ? "selected" : "" }}>{{$manufacture->name}}</option>
		@endforeach
	</select>
</br>

<input type="hidden" name="id" value="{{$product->id}}">
Select Category 

@foreach($categories as $category)

<input type="checkbox" name="category_id[]" {{$product->categories()->where('category_product.category_id', $category->id)->count() == 1  ? "checked" : "" }} value="{{$category->id}}">{{$category->category_name}} </br>
@endforeach
<input type="submit">
</form>