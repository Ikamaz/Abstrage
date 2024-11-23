<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        body {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .gallery {
            padding: 50px 20px;
            text-align: center;
        }

        .gallery h1 {
            margin-bottom: 30px;
            font-weight: bold;
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .gallery-item {
            flex: 1 0 calc(33.333% - 10px);
            margin-bottom: 15px;
            max-width: calc(33.333% - 10px);
            box-sizing: border-box;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
            border-radius: 8px;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        .card {
            border: none;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .lightbox {
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            color: white;
            font-size: 40px;
            cursor: pointer;
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

        body > div.d-flex.justify-content-center > ul > nav > ul > li.page-item.active > span {
            background-color: #343a40;
        }

        .pagination a:hover {
            background-color: #343a40;
            color: #ffffff;
        }

        .pagination .disabled a {
            color: #6c757d;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .gallery-item {
                flex: 1 0 calc(50% - 10px);
                max-width: calc(50% - 10px);
            }
        }

        @media (max-width: 576px) {
            .gallery-item {
                flex: 1 0 calc(100% - 10px);
                max-width: calc(100% - 10px);
            }
        }
    </style>
</head>

<body>
    @include('home.header')

    <section class="gallery container">
        <h1>ჩვენი გალერეა</h1>
        <div class="row gallery-grid">
            @foreach ($products as $product)
                <div class="gallery-item">
                    <div class="card">
                        <div class="card-body">
                            @if ($product->images->isNotEmpty())
                                <img src="/products/{{ $product->images->first()->image }}"
                                     alt="{{ $product->title }}"
                                     onclick="openLightbox(this)">
                            @else
                                <img src="/images/no-image.png"
                                     alt="No Image"
                                     onclick="openLightbox(this)">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div id="lightbox" class="lightbox" style="display: none;">
        <span class="close" onclick="closeLightbox()">&times;</span>
        <img id="lightbox-image" class="lightbox-content" src="" alt="Lightbox Image">
    </div>

    <div class="d-flex justify-content-center">
        <ul class="pagination">
            {{ $products->links() }}
        </ul>
    </div>

    @include('home.footer')
    @include('home.js')
</body>

</html>
