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
            font-size: 20px;
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

                <h1 style="color: white">ყველა პროდუქცია</h1>

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

                        @foreach($product as $products)

                        <tr>
                            <td>{{$products->code}}</td>
                            <td>{{$products->title}}</td>
                            <td>{!!Str::limit($products->description, 30)!!}</td>
                            <td>{{$products->category}}</td>
                            <td>{{$products->price}}</td>
                            <td>{{$products->quantity}}</td>
                            <td>
                                <img height="120px" width="120px" src="products/{{$products->image}}" alt="image">
                            </td>

                            <td>
                                <a class="btn btn-success" href="{{url('update_product', $products->id)}}">რედაქტირება</a>
                            </td>

                            <td>
                                <a class="btn btn-danger" onclick="confirmation(event)"  href="{{url('delete_product',$products->id)}}">წაშლა</a>
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

    @include('admin.js')
</body>

</html>
