<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
        .table_deg
        {
            border: 2px solid red;


        }

        th
        {
            background-color: red;
            color: black;
            font-size: 19;
            font-weight: bold;
            padding: 15px
        }

        td
        {
            border: 1px solid red;
            text-align: center;
            color: white;
        }

    </style>
</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h1>All Product</h1>

                <div class="div_deg">
                    <table class="table_deg">
                        <tr>

                            <th>სახელი</th>
                            <th>აღწერა</th>
                            <th>კატეგორია</th>
                            <th>ფასი</th>
                            <th>რაოდენობა</th>
                            <th>ფოტო</th>

                        </tr>

                        @foreach($product as $products)

                        <tr>
                            <td>{{$products->title}}</td>
                            <td>{!!Str::limit($products->description, 50)!!}</td>
                            <td>{{$products->category}}</td>
                            <td>{{$products->price}}</td>
                            <td>{{$products->quantity}}</td>
                            <td>
                                <img height="120px" width="120px" src="products/{{$products->image}}" alt="image">
                            </td>
                        </tr>

                        @endforeach
                    </table>

                </div>

                <div class="div_deg">
                    {{$product->onEachSide(1)->links()}}
                </div>



            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
</body>

</html>
