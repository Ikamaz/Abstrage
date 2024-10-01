<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
            font-size: 16px;
        }

        td {
            color: #333;
            font-size: 16px;
        }
        td img {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }
        .status-in-progress {
            color: #FFA500;
            font-weight: bold;
        }

        .status-on-the-way {
            color: #63E6BE;
            font-weight: bold;
        }

        .status-delivered {
            color: #FF0000;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 10px;
            }

            td img {
                width: 80px;
            }

            .btn {
                padding: 8px 15px;
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            table {
                width: 100%;
                font-size: 12px;
            }

            th, td {
                display: block;
                width: 100%;
                text-align: left;
                padding: 10px;
            }

            th {
                text-align: center;
            }

            td img {
                width: 100%;
                max-width: 150px;
                height: auto;
                margin: 10px 0;
            }

            .table_center {
                padding: 0 10px;
            }
        }

        /* Flexbox centering */
        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')
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
                            <td>
                                <img src="/products/{{ $data->product->image }}" alt="image">
                            </td>

                            <td>
                                @if ($data->status == 'in progress')
                                <span class="status-in-progress">{{ $data->status }}</span>
                                @elseif($data->status == 'გზაშია!')
                                <span class="status-on-the-way">
                                    <i class="fa-solid fa-truck"></i> {{ $data->status }}
                                </span>
                                @else
                                <span class="status-delivered">
                                    <i class="fa-solid fa-box-open"></i> {{ $data->status }}
                                </span>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-success" href="{{ url('on_the_way', $data->id) }}">გზაშია!</a>
                                <a class="btn btn-danger" href="{{ url('delivered', $data->id) }}">მიტანილია</a>
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
