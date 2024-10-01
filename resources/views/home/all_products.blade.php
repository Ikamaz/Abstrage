<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        .modal-content {
            max-width: 90%;
            margin: auto;
        }

        .filter-btn {
            margin: 20px;
            padding: 10px 20px;
            background-color: #343a40;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .filter-btn:hover {
            background-color: #495057;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 100%;
            }

            .close-btn {
                text-align: center;
                justify-content: center;
                align-items: center;
                justify-self: center
            }
        }

        .modal-dialog {
            max-width: 800px;
        }

        .modal-header {
            justify-content: center;
        }

        .product-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .product-item {
            flex: 1 0 30%;
            max-width: 30%;
            margin: 10px;
        }

        @media (max-width: 768px) {
            .product-item {
                flex: 1 0 45%;
                max-width: 45%;
            }
        }

        @media (max-width: 576px) {
            .product-item {
                flex: 1 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('home.header')

    <section id="decorations" class="decor-products">
        <div class="container">
            <h1 class="text-center">ჩვენი პროდუქცია</h1>
            <div class="text-center">
                <button class="filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal">ფილტრაცია</button>
            </div>
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">ფილტრაციის პარამეტრები</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="decor-sort" class="form-label">ფასის ფილტრაცია</label>
                                    <select id="decor-sort" class="form-select" onchange="decorSortProducts()">
                                        <option>აირჩიე ფილტრაცია</option>
                                        <option value="price-asc">ფასი: ზრდადი</option>
                                        <option value="price-desc">ფასი: კლებადი</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="decor-category" class="form-label">კატეგორია</label>
                                    <select id="decor-category" class="form-select"
                                        onchange="filterProductsByCategory()">
                                        <option value="all">ყველა</option>
                                        <option value="ნახატი">ნახატი</option>
                                        <option value="დეკორაცია">დეკორაცია</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price-range" class="form-label">ფასის დიაპაზონი</label>
                                    <div class="d-flex">
                                        <input type="number" id="min-price" placeholder="მინიმალური" class="form-control me-2"
                                            oninput="filterByPriceRange()">
                                        <input type="number" id="max-price" placeholder="მაქსიმალური" class="form-control"
                                            oninput="filterByPriceRange()">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="keyword-search" class="form-label">ძიება</label>
                                    <input type="text" id="keyword-search" class="form-control"
                                        onkeyup="searchByKeyword()" placeholder="საძიებო სიტყვა">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sort-date" class="form-label">თარიღი</label>
                                    <select id="sort-date" class="form-select" onchange="sortByDate()">
                                        <option value="newest">ახალი</option>
                                        <option value="oldest">ძველი</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">დახურვა</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-grid" id="product-grid">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-price="{{ $product->price }}"
                        data-category="{{ $product->category }}" data-date="{{ $product->created_at }}">
                        <div class="card product-card shadow-sm">
                            @php
                                $firstImage = $product->images->first();
                            @endphp

                            @if ($firstImage)
                                <img src="/products/{{ $firstImage->image }}" alt="{{ $product->title }}"
                                    class="card-img-top">
                            @else
                                <img src="default-image.jpg" alt="No Image Available" class="card-img-top">
                            @endif

                            <div class="card-body text-center">
                                <h2 class="card-title">{{ $product->title }}</h2>
                                <p class="card-text">{{ $product->price }} ლ</p>
                                <a href="{{ url('product_details', $product->id) }}" class="btn btn-outline-dark">ნახეთ
                                    დეტალურად</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('home.success-message')
    @include('home.footer')
    @include('home.js')

    <script>
        function decorSortProducts() {
            var sortOption = document.getElementById('decor-sort').value;
            var productsContainer = document.getElementById('product-grid');
            var products = Array.from(productsContainer.getElementsByClassName('product-item'));

            products.sort(function(a, b) {
                var priceA = parseFloat(a.getAttribute('data-price'));
                var priceB = parseFloat(b.getAttribute('data-price'));

                if (sortOption === 'price-asc') {
                    return priceA - priceB;
                } else if (sortOption === 'price-desc') {
                    return priceB - priceA;
                }
            });

            productsContainer.innerHTML = '';
            products.forEach(function(product) {
                productsContainer.appendChild(product);
            });
        }

        function filterProductsByCategory() {
            var selectedCategory = document.getElementById('decor-category').value;
            var products = Array.from(document.getElementsByClassName('product-item'));

            products.forEach(function(product) {
                var productCategory = product.getAttribute('data-category');
                if (selectedCategory === 'all' || productCategory === selectedCategory) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function filterByPriceRange() {
            var minPrice = parseFloat(document.getElementById('min-price').value) || 0;
            var maxPrice = parseFloat(document.getElementById('max-price').value) || Infinity;
            var products = Array.from(document.getElementsByClassName('product-item'));

            products.forEach(function(product) {
                var productPrice = parseFloat(product.getAttribute('data-price'));
                if (productPrice >= minPrice && productPrice <= maxPrice) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function searchByKeyword() {
            var keyword = document.getElementById('keyword-search').value.toLowerCase();
            var products = Array.from(document.getElementsByClassName('product-item'));

            products.forEach(function(product) {
                var productTitle = product.getElementsByClassName('card-title')[0].innerText.toLowerCase();
                if (productTitle.includes(keyword)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        function sortByDate() {
            var sortOption = document.getElementById('sort-date').value;
            var productsContainer = document.getElementById('product-grid');
            var products = Array.from(productsContainer.getElementsByClassName('product-item'));

            products.sort(function(a, b) {
                var dateA = new Date(a.getAttribute('data-date'));
                var dateB = new Date(b.getAttribute('data-date'));

                return sortOption === 'newest' ? dateB - dateA : dateA - dateB;
            });

            productsContainer.innerHTML = '';
            products.forEach(function(product) {
                productsContainer.appendChild(product);
            });
        }
    </script>
</body>

</html>
