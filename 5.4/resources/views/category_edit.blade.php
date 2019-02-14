<form method="POST" action="{{url('category_update')}}">
	{{csrf_field()}}

	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	

	<input type="hidden" name="id" value="{{ $category->id }}">
	<input type="text" name="category_name" value="{{ $category->category_name }}" />
	<input type="submit">


</form>



@if(Session::has('msg'))
<p class="alert alert- ">{{ Session::get('msg') }}</p>
@endif