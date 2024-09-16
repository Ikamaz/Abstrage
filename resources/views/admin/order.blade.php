<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">
        table {
            border: 2px solid red;
            text-align: center;
        }

        th {
            background-color: red;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        td {
            color: white;
            padding: 10px;
            border: 1px solid red;
        }

        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
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
                <div class="table_center">
                    <table>
                        <tr>
                            <th>მიმღების სახელი</th>
                            <th>მისამართი</th>
                            <th>ტელეფონის ნომერი</th>
                            <th>პროდუქტის სახელი</th>
                            <th>ფასი</th>
                            <th>ფოტო</th>
                            <th>პროდუქტის სტატუსი</th>
                            <th>სტატუსის შეცვლა</th>
                            <th>PDF ამობეჭდვა</th>
                        </tr>

                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->rec_address }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->product->title }}</td>
                                <td>{{ $data->product->price }}</td>
                                <td> <img width="150" src="/products/{{ $data->product->image }}" alt="image"></td>

                                <td>
                                    @if ($data->status == 'in progress')

                                        <span style="color: yellow">{{ $data->status }}</span>

                                    @elseif($data->status == 'გზაშია!')

                                        <span style="color: #63E6BE"><i class="fa-solid fa-truck" style="color: #63E6BE;"></i> {{ $data->status }}</span>

                                    @else

                                    <span style="color: #ff0000"><i class="fa-solid fa-box-open" style="color: #ff0000;"></i> {{ $data->status }}</span>

                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('on_the_way', $data->id) }}">გზაშია!</a>

                                    <a class="btn btn-primary" href="{{ url('delivered', $data->id) }}">მიტანილია</a>

                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{url('print_pdf', $data->id )}}">ამობეჭდვა</a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>
