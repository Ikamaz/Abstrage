<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')

    <!-- Decoration Products Section -->
    <section id="decorations" class="decor-products">
        <h1>ჩვენი დეკორაცია</h1>

        <div class="decor-filter-container">
            <label for="decor-sort">ფილტრაცია </label>
            <select id="decor-sort" onchange="decorSortProducts()">
                <option value="price-asc">ფასი: ზრდადი</option>
                <option value="price-desc">ფასი: კლებადი</option>
            </select>
        </div>
        {{--
    @foreach ($product as $products)

    <div class="decor-product-grid">
      <div class="decor-product-card" data-price="{{$products->price}}">
        <img src="products/{{$products->image}}" alt="Product">
        <h2>{{$products->title}}</h2>
        <p>{{$products->price}} ლ</p>
        <button>კალათში დამატება</button>
      </div>
    </div>

    @endforeach --}}
        <div class="container">
            <div class="row">
                @foreach ($product as $products)
                    <div class="col-4">
                        <div class="card" data-price="{{ $products->price }}">
                            <img class="card-img-top" style="height: 300px; object-fit: cover;" src="products/{{ $products->image }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $products->title }}</h5>
                                <p class="card-text">{{ $products->price }} ლ</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    @include('home.success-message')
    <!-- Footer -->
    @include('home.footer')
    @include('home.js')
</body>

</html>
