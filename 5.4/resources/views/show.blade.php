<h2>Product Name: </h2>
<p>{{ $product->product_name }} || </p>

<h3>Product Belongs to</h3>
 
<ul>
    @foreach($product->categories as $category)
    <li>{{ $category->category_name }}</li>
    @endforeach
  

   {{$product->manufactures->name}}
</ul>