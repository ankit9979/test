<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
</head>
<body>

	<form method="get" action="{{route('search_result')}}">

		{{csrf_field()}}

		<div class="form-group ">
			<select name="category_id" class="form-class">
				<option value=" ">Select</option>
				@foreach ($cateogries as $category)
				<option value="{{$category->id}}">{{$category->category_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			@foreach ($manufactures as $manufacture)
			<input type="checkbox" name="manufacture_id[]" value="{{$manufacture->id}}">{{$manufacture->id}}</br>
			@endforeach
		</div>
		<div class="form-group">
			@foreach ($attributes as $attribute)
			<input type="checkbox" name="attribute_id[]" value="{{$attribute->id}}">{{$attribute->key . ' '. $attribute->value}}</br>
			@endforeach
		</div>
		
		<div class="form-group">


		</div>


		<input type="submit" value="search">
	</form>


	<table>
		<tr><th>Name</th></tr>
		@if (!empty($products))
		@foreach ($products as $product)
		<tr><td>{{$product->product_name}}</td></tr>
		@endforeach 
		@endif
		
	</table>
</body>
</html> 

