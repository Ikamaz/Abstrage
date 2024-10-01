<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style type="text/css">
        .div_design {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border: 2px solid red;
            border-radius: 5px;
        }

        .table_deg {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: red;
            color: black;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
        }

        td {
            border: 1px solid red;
            text-align: center;
            color: white;
            padding: 10px;
            background-color: #1e1e1e;
        }

        .input-group {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 10px;
        }

        input[type='text'] {
            flex: 1;
            height: 50px;
            padding: 0 15px;
            margin-right: 10px;
            border: 2px solid #f44336;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: white;
            font-size: 16px;
        }

        .add-category {
            height: 50px;
            padding: 0 20px;
            font-size: 16px;
        }

        @media (max-width: 600px) {
            .table_deg {
                font-size: 12px;
            }

            input[type='text'] {
                font-size: 14px;
                padding: 10px 15px;
            }

            .btn {
                font-size: 14px;
            }

            .input-group {
                flex-direction: column;
                width: 100%;
            }

            input[type='text'] {
                width: 100%;
                height: auto;
                margin-right: 0;
                margin-top: 10px;
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
                <h1 style="color: white">კატეგორიის დამატება</h1>

                <div class="div_design">
                    <form action="{{ url('add_category') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="category" placeholder="კატეგორიის სახელი" required>
                            <input class="btn btn-primary add-category" type="submit" value="დაამატე კატეგორია">
                        </div>
                    </form>
                </div>

                <div class="table-container">
                    <table class="table_deg">
                        <tr>
                            <th>კატეგორიის სახელი</th>
                            <th>რედაქტირება</th>
                            <th>წაშლა</th>
                        </tr>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->category_name }}</td>
                                <td>
                                    <a class="btn btn-success"
                                        href="{{ url('edit_category', $data->id) }}">რედაქტირება</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="confirmation(event)"
                                        href="{{ url('delete_category', $data->id) }}">წაშლა</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
