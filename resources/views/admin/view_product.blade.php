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
            width: 500px;
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
        }

        .table_deg {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
        }

        th, td {
            padding: 15px;
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

        .btn-success, .btn-danger {
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
                        @foreach ($product as $products)
                        <tr>
                            <td>{{ $products->code }}</td>
                            <td>{{ $products->title }}</td>
                            <td>{!! Str::limit($products->description, 30) !!}</td>
                            <td>{{ $products->category }}</td>
                            <td>{{ $products->price }}</td>
                            <td>{{ $products->quantity }}</td>
                            <td>
                                <img height="120px" width="120px" src="products/{{ $products->image }}" alt="image">
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ url('update_product', $products->id) }}">რედაქტირება</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_product', $products->id) }}">წაშლა</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="div_deg pagination">
                    {{ $product->onEachSide(1)->links() }}
                </div>

            </div>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
