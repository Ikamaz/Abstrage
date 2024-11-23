<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>

<body>
    @include('home.header')
    <section id="product-detail" class="product-detail">
        <div class="product-container">
            <div class="image-info-container">
                <div class="main-image">
                    @if ($data->images && count($data->images) > 0)
                        <img id="main-product-image" src="/products/{{ $data->images[0]->image }}" alt="Product Image"
                            onclick="openLightbox(this.src)">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <div class="thumbnail-images">
                    @foreach ($data->images as $image)
                        <img class="thumbnail" src="/products/{{ $image->image }}" alt="Product Thumbnail"
                            onclick="changeImage('{{ $image->image }}')">
                    @endforeach
                </div>
                <div class="product-info">
                    <h1>{{ $data->title }}</h1>
                    <p class="code"><strong>კოდი -</strong> {{ $data->code }}</p>
                    <p class="category"><strong>კატეგორია -</strong> {{ $data->category }}</p>
                    <p class="quantity"><strong>რაოდენობა -</strong> {{ $data->quantity }}</p>
                    <p class="description"><strong>აღწერა -</strong> {{ $data->description }}</p>
                    @if ($data->discount_price)
                        <div class="price-container" style="display: flex; gap: 10px; align-items: center;">
                            <p class="original-price text-muted" style="text-decoration: line-through; color: #888;">
                                ₾{{ $data->price }}</p>
                            <p class="discounted-price text-danger" style="font-weight: bold;">
                                ₾{{ $data->discount_price }}</p>
                        </div>
                    @else
                        <p class="price">₾{{ $data->price }}</p>
                    @endif

                    <div class="product-actions">
                        @if ($data->is_ordered)
                            <button class="add-to-cart" disabled>პროდუქტი ხელმისაწვდომი არ არის</button>
                        @else
                            <form action="{{ route('cart.add', $data->id) }}" method="POST">
                                @csrf
                                <label for="quantity">რაოდენობა </label>
                                <input type="number" id="quantity" name="quantity" min="1"
                                    max="{{ $data->quantity }}" value="1" required>
                                <button type="submit" class="add-to-cart">კალათში დამატება</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="related-products">
                <div class="related-products-header">
                    <h2>მსგავსი პროდუქცია</h2>
                </div>
                <div class="owl-carousel owl-theme" id="related-products-list">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="related-product-card">
                            <img src="/products/{{ $relatedProduct->images->first()->image }}"
                                alt="{{ $relatedProduct->title }}">
                            <h3>{{ $relatedProduct->title }}</h3>
                            <p>{{ $relatedProduct->price }} ლარი</p>
                            <a href="{{ url('product_details', $relatedProduct->id) }}">
                                <button class="details-btn-card">იხილეთ დეტალურად</button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="lightbox" class="lightbox" style="display: none;">
            <span class="close" onclick="closeLightbox()">&times;</span>
            <img id="lightbox-image" class="lightbox-content" src="" alt="Lightbox Image">
        </div>
    </section>
    @include('home.footer')
    @include('home.js')
    <script>
        $(document).ready(function() {
            $('#related-products-list').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 5520,
                smartSpeed: 1500,
                animateIn: 'linear',
                animateOut: 'linear',
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>

</body>

</html>
