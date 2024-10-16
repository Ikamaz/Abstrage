<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        /* General Styling */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .text-center {
            margin-bottom: 30px;
        }

        /* Filter Button */
        .filter-btn {
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-btn:hover {
            background-color: #495057;
        }

        /* Product Grid */
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .product-item {
            flex: 1 1 30%;
            max-width: 30%;
            box-sizing: border-box;
        }

        .product-card {
            border: none;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #e0e0e0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-outline-dark {
            border-color: #343a40;
            color: #343a40;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-dark:hover {
            background-color: #343a40;
            color: white;
        }

        /* Pagination & Filter Modal */
        .modal-content {
            padding: 20px;
        }

        .modal-header h5 {
            font-size: 1.5rem;
        }

        .modal-body label {
            font-size: 1.1rem;
        }

        .modal-footer {
            padding: 15px;
        }

        /* Per-page Dropdown */
        #per_page {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .product-item {
                flex: 1 1 45%;
                max-width: 45%;
            }

            .modal-dialog {
                max-width: 80%;
            }
        }

        @media (max-width: 768px) {
            .product-item {
                flex: 1 1 100%;
                max-width: 100%;
            }

            h1 {
                font-size: 2rem;
            }

            .btn {
                font-size: 1rem;
                padding: 8px 15px;
            }

            .filter-btn {
                padding: 8px 15px;
            }
        }

        @media (max-width: 480px) {
            .product-item {
                flex: 1 1 100%;
                max-width: 100%;
                margin: 0 auto; /* Center product items */
            }

            .product-card {
                padding: 15px;
            }

            .card-img-top {
                height: 180px;
            }

            .card-body {
                padding: 15px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .btn, .filter-btn {
                padding: 6px 10px;
            }
        }

        @media (max-width: 320px) {
            .product-grid {
                padding: 0 10px; /* Add padding to prevent content touching the edges */
            }

            .product-item {
                flex: 1 1 100%;
                max-width: 100%;
                margin: 0 auto; /* Center product items */
            }

            .product-card {
                padding: 10px;
            }

            .card-img-top {
                height: 150px;
            }

            .card-body {
                padding: 10px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .btn, .filter-btn {
                padding: 5px 8px;
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

            <!-- Filter Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">ფილტრაციის პარამეტრები</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="sort" class="form-label">ფასის ფილტრაცია</label>
                                        <select name="sort" id="sort" class="form-select">
                                            <option value="">აირჩიე ფილტრაცია</option>
                                            <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>ფასი: ზრდადი</option>
                                            <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>ფასი: კლებადი</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">კატეგორია</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="all">ყველა</option>
                                            @foreach ($uniqueCategories as $category)
                                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="min_price" class="form-label">ფასის დიაპაზონი</label>
                                        <div class="d-flex">
                                            <input type="number" name="min_price" value="{{ request('min_price') }}" id="min_price" placeholder="მინიმალური" class="form-control me-2" min="0">
                                            <input type="number" name="max_price" value="{{ request('max_price') }}" id="max_price" placeholder="მაქსიმალური" class="form-control" min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sort_date" class="form-label">თარიღი</label>
                                        <select name="sort_date" id="sort_date" class="form-select">
                                            <option value="">აირჩიე თარიღი</option>
                                            <option value="newest" {{ request('sort_date') == 'newest' ? 'selected' : '' }}>ახალი</option>
                                            <option value="oldest" {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>ძველი</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">გაფილტვრა</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">დახურვა</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="product-grid" id="product-grid">
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 mb-4 product-item">
                    <div class="card product-card shadow-sm">
                        @php
                        $firstImage = $product->images->first();
                        @endphp
                        <img src="{{ $firstImage ? '/products/' . $firstImage->image : 'default-image.jpg' }}" alt="{{ $product->title }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h2 class="card-title">{{ $product->title }}</h2>
                            <p class="card-text">{{ $product->price }} ლ</p>
                            <a href="{{ url('product_details', $product->id) }}" class="btn btn-outline-dark">ნახეთ დეტალურად</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <label for="per_page">პროდუქციის რაოდენობა ერთ გვერდზე </label>
                    <select id="per_page" onchange="updatePerPage(this.value)">
                        <option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9</option>
                        <option value="18" {{ request('per_page') == 18 ? 'selected' : '' }}>18</option>
                        <option value="27" {{ request('per_page') == 27 ? 'selected' : '' }}>27</option>
                    </select>
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>

    @include('home.footer')

    <script>
        function updatePerPage(value) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('per_page', value);
            window.location.search = urlParams.toString();
        }
    </script>
    @include('home.js')

</body>
</html>
