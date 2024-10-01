<section id="gallery" class="products">

    @foreach ($products as $product)
        <div class="product-card">
            @php
                $firstImage = $product->images->first();
            @endphp

            @if ($firstImage)
                <img class="product-image" src="/products/{{ $firstImage->image }}" alt="Product Image">
            @else
                <img class="product-image" src="default-image.jpg" alt="No Image Available">
            @endif
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->price }} ლარი</p>
            <a href="{{ url('product_details', $product->id) }}"><button>იხილეთ დეტალურად</button></a>
        </div>
    @endforeach
</section>
