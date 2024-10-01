<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        .gallery {
            padding: 50px 0;
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
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        .card {
            margin: 15px;
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
    </style>
</head>

<body>
    @include('home.header')

    <section class="gallery container">
        <h1>ჩვენი გალერეა</h1>
        <div class="row gallery-grid">
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-6 gallery-item">
                    <div class="card">
                        <div class="card-body">
                            @if ($product->images->isNotEmpty())
                                <img src="/products/{{ $product->images->first()->image }}" alt="{{ $product->title }}" class="img-fluid" onclick="openLightbox(this.src)">
                            @else
                                <img src="/images/no-image.png" alt="No Image" class="img-fluid" onclick="openLightbox(this.src)">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div id="lightbox" class="lightbox" style="display: none;">
        <span class="close" onclick="closeLightbox()">&times;</span>
        <img class="lightbox-content" id="lightbox-image">
    </div>

    @include('home.footer')

    @include('home.js')

</body>

</html>
