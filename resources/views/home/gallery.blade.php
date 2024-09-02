<section id="gallery" class="products">

    @foreach($product as $products)

    <div class="product-card">
        <img src="products/{{$products->image}}" alt="Product 1">
        <h2>{{$products->title}}</h2>
        <p>{{$products->price}} ლარი</p>
        <a href="{{url('product_details', $products->id)}}"><button>იხილეთ დეტალურად</button></a>
    </div>

    @endforeach
</section>
