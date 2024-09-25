
<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')

<section id="decorations" class="decor-products">

    <h1>ჩვენი დეკორაცია</h1>

    <div class="decor-filter-container">
      <label for="decor-sort">ფილტრაცია </label>
      <select id="decor-sort" onchange="decorSortProducts()">
        <option>აირჩიე სორტირება</option>
        <option value="price-asc">ფასი: ზრდადი</option>
        <option value="price-desc">ფასი: კლებადი</option>
      </select>
    </div>

    <div class="decor-product-grid">
      <div class="decor-product-card" data-price="120">
        <img src="img/product1.jpg" alt="Product 1">
        <h2>ნივთი 1</h2>
        <p>120 ლ</p>
        <button onclick="decorAddToCart()">კალათში დამატება</button>
      </div>
      <div class="decor-product-card" data-price="80">
        <img src="img/product2.jpg" alt="Product 2">
        <h2>ნივთი 2</h2>
        <p>80 ლ</p>
        <button onclick="decorAddToCart()">კალათში დამატება</button>
      </div>
      <div class="decor-product-card" data-price="150">
        <img src="img/product3.jpg" alt="Product 3">
        <h2>ნივთი 3</h2>
        <p>150 ლ</p>
        <button onclick="decorAddToCart()">კალათში დამატება</button>
      </div>
      <!-- Add more product cards as needed -->
    </div>
  </section>

  @include('home.success-message')

    <!-- Footer -->
    @include('home.footer')


    @include('home.js')
</body>

</html>
