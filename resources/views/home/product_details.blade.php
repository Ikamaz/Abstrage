<!DOCTYPE html>
<html lang="en">

<head>

    @include('home.css')

</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')
    <!-- Product details -->
    <section id="product-detail" class="product-detail">
        <div class="product-container">
            <div class="main-image">
                @if ($data)
                    <img src="/products/{{ $data->image }}" alt="Product">
                @else
                    <p>No image available</p>
                @endif
            </div>
            <div class="product-info">
                <h1>{{ $data->title }}</h1>
                <p class="code"><strong>კოდი:</strong> {{ $data->code }}</p>
                <p class="category"><strong>კატეგორია:</strong> {{ $data->category }}</p>
                <p class="quantity"><strong>რაოდენობა:</strong> {{ $data->quantity }}</p>
                <p class="description"><strong>აღწერა:</strong> {{ $data->description }}</p>
                <p class="price">{{ $data->price }} ლარი</p>
                <div class="product-actions">
                    <a href="{{ url('add_cart', $data->id) }}"><button class="add-to-cart">კალათში
                            დამატება</button></a>
                </div>
            </div>
        </div>
    </section>

    @include('home.success-message')

    <!-- Footer -->
    @include('home.footer')


    @include('home.js')
</body>

</html>
