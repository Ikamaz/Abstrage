<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

    <style>
        /* General Styles */
        body {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .product-detail {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            padding: 20px;
        }

        .product-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }

        .image-info-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            /* Align to the start for consistent spacing */
            margin-bottom: 20px;
        }

        .main-image {
            flex: 1;
            /* Allow the main image to take available space */
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 400px;
        }

        .main-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: transform 0.3s;
            cursor: pointer;
        }

        .main-image img:hover {
            transform: scale(1.04);
        }

        .product-info {
            padding: 30px;
            /* Increase padding for a more spacious layout */
            background: #ffffff;
            /* Keep a white background for contrast */
            border-radius: 12px;
            /* Rounded corners for a modern look */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
            display: flex;
            flex-direction: column;
            /* Stack items vertically */
            justify-content: space-between;
            /* Evenly distribute space */
            height: auto;
            /* Allow height to adjust based on content */
            width: 100%;
            max-width: 500px;
            /* Set a larger max width */
            min-width: 400px;
            /* Maintain a minimum width for smaller screens */
            transition: all 0.3s ease;
            /* Smooth transition for hover effects */
        }

        .product-info h1 {
            font-size: 2em;
            /* Larger font size for the title */
            margin: 0 0 15px 0;
            /* Add bottom margin for spacing */
            color: #333;
            /* Dark color for better readability */
        }

        .product-info p {
            margin: 8px 0;
            /* Adjust margin for better spacing */
            color: #555;
            /* Slightly lighter color for description text */
            line-height: 1.5;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .product-actions {
            margin-top: 30px;
            /* Space above action buttons */
        }

        .add-to-cart {
            padding: 10px 22px;
            background: black !important;
            color: white !important;
            border: none !important;
            border-radius: 30px !important;
            font-size: 1em !important;
            font-weight: bold !important;
            cursor: pointer !important;
            transition: all 0.3s;
        }

        .add-to-cart:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            transform: scale(1.04);
        }

        .add-to-cart:disabled {
            background: #ddd;
            color: #999;
            cursor: not-allowed;
        }

        .thumbnail-images {
            margin: 30px;
            /* Adjusted for spacing */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .thumbnail {
            width: 70px;
            height: auto;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: transform 0.2s;
        }

        .thumbnail:hover {
            transform: scale(1.1);
        }

        .related-products {
            margin-top: 30px;
        }

        .related-products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .related-product-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin: 10px;
            flex: 1;
            /* Allow cards to take equal space */
        }

        #related-products-list>div.owl-nav {
            margin: 15px;
        }

        #related-products-list .owl-nav button.owl-next span,
        #related-products-list .owl-nav button.owl-prev span {
            padding: 11px 22px !important;
            background: black !important;
            color: white !important;
            border: none !important;
            border-radius: 30px !important;
            font-size: 1.5em !important;
            font-weight: bold !important;
            cursor: pointer !important;
            transition: background 0.3s !important;
        }

        #related-products-list .owl-nav button.owl-next:hover span,
        #related-products-list .owl-nav button.owl-prev:hover span {
            background: #333 !important;
        }

        .owl-carousel .owl-nav button {
            background: none !important;
            border: none !important;
            padding: 0 !important;
            color: inherit !important;
            font: inherit !important;
        }

        .related-product-card:hover {
            transform: scale(1.02);
        }

        .related-product-card img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .related-product-card h3 {
            margin: 10px 0;
            font-weight: bold;
            font-size: 1.2em;
        }

        .related-product-card p {
            margin: 5px 0;
            font-size: 1em;
            color: #666;
        }

        /* Lightbox Styles */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .image-info-container {
                flex-direction: column;
                align-items: center;
            }

            .main-image img {
                max-width: 60%;
            }

            .thumbnail-images {
                flex-direction: row;
            }

            .product-info {
                max-width: 90%;
                /* Allow more width on smaller screens */
                padding: 20px;
                /* Adjust padding for smaller screens */
            }

            .related-product-card {
                max-width: 90%;
                margin: 10px auto;
                /* Center cards on small screens */
            }

            .product-info h1 {
                font-size: 1.8em;
                /* Adjust title size for smaller screens */
            }

            .product-info p {
                font-size: 1em;
                /* Maintain a consistent text size */
            }

            .add-to-cart {
                padding: 10px;
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .product-info h1 {
                font-size: 1.3em;
                /* Further reduce title size for mobile */
            }

            .product-info p {
                font-size: 0.8em;
                /* Further reduce text size for mobile */
            }

            .thumbnail {
                width: 60px;
            }
        }
    </style>

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
                            onclick="openLightbox()">
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
                    <p class="price">{{ $data->price }} ლარი</p>

                    <div class="product-actions">
                        @if ($data->is_ordered)
                            <button class="add-to-cart" disabled>პროდუქტი ხელმისაწვდომი არ არის</button>
                        @else
                            <a href="{{ url('add_cart', $data->id) }}">
                                <button class="add-to-cart">კალათში დამატება</button>
                            </a>
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
                            <a href="{{ url('add_cart', $relatedProduct->id) }}">
                                <button class="add-to-cart">კალათში დამატება</button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Lightbox -->
        <div class="lightbox" id="lightbox" onclick="closeLightbox()">
            <span class="close" onclick="closeLightbox()">&times;</span>
            <div class="lightbox-content">
                <img id="lightbox-image" src="" alt="Lightbox Image" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </section>

    @include('home.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        function changeImage(imageSrc) {
            document.getElementById('main-product-image').src = '/products/' + imageSrc;
        }

        function openLightbox() {
            const lightbox = document.getElementById('lightbox');
            const mainImageSrc = document.getElementById('main-product-image').src;
            document.getElementById('lightbox-image').src = mainImageSrc;
            lightbox.style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        $(document).ready(function() {
            $('#related-products-list').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
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
