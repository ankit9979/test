@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<form method="POST" action="{{route('product_store')}}">
	{{csrf_field()}}

	<input type="text" name="product_name" placeholder="product name">  </br>
	<input type="text" name="product_desc" placeholder="product desc"></br>
	<select name="manufature_id">
		<option value=" ">Select </option>
		@foreach($manufactures as $manufacture)
		<option value="{{$manufacture->id}}">{{$manufacture->name}}</option>
		@endforeach
	</select>
</br>
Select Category 

@foreach($categories as $category)
<input type="checkbox" name="category_id[]" value="{{$category->id}}">{{$category->category_name}} </br>
@endforeach

</ br>
Select Atribute 

@foreach($attributes as $attribute)

<input type="checkbox" name="attributes[]" value='{{json_encode(array($attribute->id=>$attribute->key))}}'>{{$attribute->key.' '.$attribute->value}} </br>
@endforeach



<input type="submit">
</form>

<table>
	<tr><th>Name</th><th>Manufacture</th><th>category</th><th>Edit</th><th>Delete</th></tr>
	@if(!empty($products))
	@foreach($products as  $product)
	<tr><td>{{$product->product_name}}</td>
		<td>{{$product->manufactures->name}}</td>
		<td>
			@foreach($product->categories as $category)
			<li>{{ $category->category_name }}</li>
			@endforeach
		</td>
		<td><a href="{{route('product_edit',$product->id)}}">Edit</a></td><td>Delete</td></tr>
		@endforeach
		@endif
	</table>