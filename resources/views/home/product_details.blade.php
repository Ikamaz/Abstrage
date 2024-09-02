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
                <img src="/products/{{ $data->image }}" alt="Product">
            </div>
            <div class="product-info">
                <h1>{{ $data->title }}</h1>
                <p class="code"><strong>კოდი:</strong> {{ $data->code }}</p>
                <p class="category"><strong>კატეგორია:</strong> {{ $data->category }}</p>
                <p class="quantity"><strong>რაოდენობა:</strong> {{ $data->quantity }}</p>
                <p class="description"><strong>აღწერა:</strong> {{ $data->description }}</p>
                <p class="price">{{ $data->price }} ლარი</p>
                <div class="product-actions">
                    <a href="{{url('add_cart', $products->id )}}"><button class="add-to-cart">კალათში დამატება</button></a>
                    <button class="buy-now">გადანახვა</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('home.footer')


    @include('home.js')
</body>

</html>
