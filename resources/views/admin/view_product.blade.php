<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style type="text/css">
        .page-header h1 {
            color: white;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        input[type="search"] {
            width: 100%;
            max-width: 500px;
            height: 50px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: box-shadow 0.3s ease;
            font-size: 16px;
        }

        input[type="search"]:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .btn {
            margin-left: 20px;
            padding: 12px 25px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
            width: 100%;
            overflow-x: auto;
        }

        .table_deg {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: white;
            font-size: 18px;
            letter-spacing: 0.05em;
        }

        td {
            border: 1px solid #dee2e6;
            font-size: 16px;
            color: #495057;
        }

        td img {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        td img:hover {
            transform: scale(1.05);
        }

        .btn-success,
        .btn-danger {
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .pagination .page-link {
            color: #007bff;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
        }

        .image-gallery {
            display: flex;
            gap: 10px;
            /* Space between images */
            justify-content: center;
            /* Center images */
            flex-wrap: wrap;
            /* Allow images to wrap on smaller screens */
        }

        .image-gallery img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            /* Ensure the images are cropped correctly */
            border-radius: 6px;
            /* Slight rounding for visual appeal */
            transition: transform 0.3s ease;
        }

        .image-gallery img:hover {
            transform: scale(1.1);
            /* Slight zoom on hover */
        }


        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2em;
            }

            form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="search"] {
                width: 100%;
                margin-bottom: 20px;
            }

            .btn {
                margin-left: 0;
                width: 100%;
            }

            .table_deg {
                font-size: 14px;
            }

            th,
            td {
                padding: 10px;
            }

            td img {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.8em;
            }

            th,
            td {
                padding: 8px;
            }

            td img {
                width: 80px;
                height: 80px;
            }

            .btn-success,
            .btn-danger {
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>ყველა პროდუქცია</h1>

                <form action="{{ url('product_search') }}" method="GET">
                    @csrf
                    <input type="search" name="search" placeholder="პროდუქციის მოძებნა">
                    <input type="submit" class="btn btn-secondary" value="მოძებნა">
                </form>

                <div class="div_deg">
                    <table class="table_deg">
                        <tr>
                            <th>კოდი</th>
                            <th>სახელი</th>
                            <th>აღწერა</th>
                            <th>კატეგორია</th>
                            <th>ფასი</th>
                            <th>რაოდენობა</th>
                            <th>ფოტო</th>
                            <th>რედაქტირება</th>
                            <th>წაშლა</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{!! Str::limit($product->description, 30) !!}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <div class="image-gallery">
                                        @if (isset($productImages[$product->id]) && count($productImages[$product->id]) > 0)
                                            <img src="/products/{{ $productImages[$product->id]->first()->image }}" alt="Product Image">
                                        @else
                                            <img src="/images/default.png" alt="No Image Available">
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('update_product', $product->id) }}">რედაქტირება</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="confirmation(event)"
                                        href="{{ url('delete_product', $product->id) }}">წაშლა</a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>

                <div class="div_deg pagination">
                    {{ $products->onEachSide(1)->links() }}
                </div>


            </div>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
