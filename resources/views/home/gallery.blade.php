@include('home.css')
<section id="gallery" class="products container">
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
            <div class="price-wrapper">
                @if ($product->discount_price)
                    <div class="price-container">
                        <p class="original-price">₾{{ $product->price }}</p>
                        <p class="discounted-price">₾{{ $product->discount_price }}</p>
                    </div>
                @else
                    <p class="price">₾{{ $product->price }}</p>
                @endif
            </div>
            <a href="{{ url('product_details', $product->id) }}" class="btn btn-outline-dark details-btn">იხილეთ
                დეტალურად</a>
        </div>
    @endforeach
</section>
