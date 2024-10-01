<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    @include('home.header')
    <section id="product-detail" class="product-detail">
        <div class="product-container">
            <div class="image-info-container">
                <div class="main-image">
                    @if ($data->images && count($data->images) > 0)
                        <img id="main-product-image" src="/products/{{ $data->images[0]->image }}" class="display:" alt="Product Image" onclick="openLightbox()">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <div class="product-info">
                    <h1>{{ $data->title }}</h1>
                    {{-- <div class="ratings">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="reviews-count">(12 Reviews)</span>
                    </div> --}}
                    <p class="code"><strong>კოდი:</strong> {{ $data->code }}</p>
                    <p class="category"><strong>კატეგორია:</strong> {{ $data->category }}</p>
                    <p class="quantity"><strong>რაოდენობა:</strong> {{ $data->quantity }}</p>
                    <p class="description"><strong>აღწერა:</strong> {{ $data->description }}</p>
                    <p class="price">{{ $data->price }} ლარი</p>
                    <div class="product-actions">
                        <a href="{{ url('add_cart', $data->id) }}">
                            <button class="add-to-cart">კალათში დამატება</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Images -->
            <div class="thumbnail-images">
                @foreach ($data->images as $image)
                    <img class="thumbnail" src="/products/{{ $image->image }}" alt="Product Thumbnail"
                         onclick="changeImage('{{ $image->image }}')">
                @endforeach
            </div>

            <div class="related-products">
                <h2>Related Products</h2>
                <div class="related-products-grid">
                    <div class="related-product-card">
                        <img src="/products/related-product.jpg" alt="Related Product">
                        <h3>Related Product Title</h3>
                        <p>Price: 40 ლარი</p>
                        <button class="add-to-cart">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.success-message')
    @include('home.footer')
    @include('home.js')

    <div id="lightbox" style="display: none" class="lightbox" onclick="closeLightbox()">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightbox-image">
    </div>

    <script>
        function changeImage(imageUrl) {
            document.getElementById('main-product-image').src = '/products/' + imageUrl;
        }

        function openLightbox() {
            document.getElementById('lightbox').style.display = 'block';
            document.getElementById('lightbox-image').src = document.getElementById('main-product-image').src;
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script>
</body>
</html>
