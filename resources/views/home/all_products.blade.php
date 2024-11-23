<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .text-center {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            margin-bottom: 30px;
        }

        .filter-btn {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
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

        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 1rem);
            margin: 0 auto;
        }

        .modal-content {
            transition: transform 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
            width: 100%;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            padding: 0;
            list-style-type: none;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            border-radius: 50px;
            color: #343a40;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #343a40;
            color: #ffffff;
        }

        #decorations>div>div.d-flex.justify-content-center>ul>nav>ul>li.page-item.active>span {
            background-color: #343a40;
            color: #ffffff;
            border: 1px solid #343a40;
        }

        .pagination .disabled a {
            color: #6c757d;
            cursor: not-allowed;
        }

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
            height: auto;
            object-fit: cover;
            border-bottom: 2px solid #e0e0e0;
        }

        .card-body {
            padding: 15px;
        }

        .modal-content {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            padding: 20px;
        }

        .modal-header h5 {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            font-size: 1.5rem;
        }

        .modal-body label {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            font-size: 1.1rem;
        }

        .modal-body select,
        .modal-body select option,
        .modal-body input {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
        }

        .modal-footer {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            padding: 10px;
        }

        #per_page {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

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
                flex: 1 1 48%;
                max-width: 48%;
            }


            .card-img-top {
                height: auto;
            }

            .modal-dialog {
                max-width: 90%;
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
            .min-max-price {
                flex-direction: column;
                gap: 10px;
            }

            .product-item {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .product-card {
                padding: 15px;
            }

            .card-img-top {
                height: auto;
            }


            .card-body {
                padding: 10px;
            }

            h1 {
                font-size: 1.8rem;
                font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            }


            .btn,
            .filter-btn {
                padding: 6px 10px;
            }

            .modal-dialog {
                max-width: 95%;
                margin-top: 10px;
            }

            .modal-content {
                padding: 15px;
            }
        }

        @media (max-width: 320px) {
            .product-grid {
                padding: 0 10px;
            }

            .product-item {
                flex: 1 1 100%;
                max-width: 100%;
                margin: 0 auto;
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

            .btn,
            .filter-btn {
                padding: 5px 8px;
            }

            .modal-dialog {
                max-width: 95%;
                margin: 0 auto;
                margin-top: 10px;
                transform: translate(0, 50%);
            }

            .modal-content {
                padding: 10px;
            }
        }
    </style>


</head>

<body>
    @include('home.header')
    <section id="decorations" class="decor-products">
        <div class="container">
            <h1 class="text-center custom-font">ჩვენი პროდუქცია</h1>
            <div class="text-center">
                <button class="filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal"
                    aria-label="Open filter options">ფილტრაცია</button>
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
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="sort" class="form-label">ფასის ფილტრაცია</label>
                                        <select name="sort" id="sort" class="form-select">
                                            <option value="">აირჩიე ფილტრაცია</option>
                                            <option value="price-asc"
                                                {{ request('sort') == 'price-asc' ? 'selected' : '' }}>ფასი: ზრდადი
                                            </option>
                                            <option value="price-desc"
                                                {{ request('sort') == 'price-desc' ? 'selected' : '' }}>ფასი: კლებადი
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">კატეგორია</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="all">ყველა</option>
                                            @foreach ($uniqueCategories as $category)
                                                <option value="{{ $category }}"
                                                    {{ request('category') == $category ? 'selected' : '' }}>
                                                    {{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="min_price" class="form-label">ფასის დიაპაზონი</label>
                                        <div class="d-flex min-max-price">
                                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                                id="min_price" placeholder="მინიმალური" class="form-control me-2"
                                                min="0">
                                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                                id="max_price" placeholder="მაქსიმალური" class="form-control"
                                                min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sort_date" class="form-label">თარიღი</label>
                                        <select name="sort_date" id="sort_date" class="form-select">
                                            <option value="">აირჩიე თარიღი</option>
                                            <option value="newest"
                                                {{ request('sort_date') == 'newest' ? 'selected' : '' }}>ახალი</option>
                                            <option value="oldest"
                                                {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>ძველი</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">გაფილტვრა</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">დახურვა</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-grid" id="product-grid">
                @foreach ($products as $product)
                    <div class="product-item">
                        <div class="card product-card shadow-sm">
                            @php
                                $firstImage = $product->images->first();
                            @endphp
                            <img src="{{ $firstImage ? '/products/' . $firstImage->image : 'default-image.jpg' }}"
                                alt="Image of {{ $product->title }} priced at {{ $product->price }} ლ"
                                class="card-img-top">
                            <div class="card-body text-center">
                                <h2 class="card-title">{{ $product->title }}</h2>
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
                                @if ($product->is_ordered)
                                    <a href="{{ url('product_details', $product->id) }}"
                                        class="btn btn-outline-danger">გაყიდულია</a>
                                @else
                                    <a href="{{ url('product_details', $product->id) }}"
                                        class="btn btn-outline-dark">ნახეთ დეტალურად</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    {{ $products->appends(request()->query())->links() }}
                </ul>
            </div>

        </div>
    </section>

    @include('home.footer')
    @include('home.js')

</body>

</html>
