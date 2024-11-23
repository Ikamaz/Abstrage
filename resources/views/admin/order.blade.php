<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        body {
            margin: 0;
            background-color: #2D3035;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .d-flex {
            flex: 1;
            display: flex;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #2D3035;
            border-radius: 8px;
            flex: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        .filter-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-section input,
        .filter-section select,
        .bulk-actions button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            flex: 1 1 50px;
            /* min-width: 150px;  */
            box-sizing: border-box;
        }

        .bulk-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        p {
            color: black;
        }

        .order-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 15px;
            background-color: whitesmoke;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            flex-direction: row;
            flex-wrap: wrap;
        }

        .order-card img {
            max-width: 100px;
            border-radius: 5px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .order-details {
            flex: 1;
            min-width: 200px;
        }

        p {
            color: #000000;
        }

        input {
            color: #000000;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: #fff;
            margin-top: 10px;
            display: inline-block;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .badge-in-progress {
            background-color: orange;
        }

        .badge-on-the-way {
            background-color: red;
        }

        .badge-saved {
            background-color: #17a2b8;
        }

        .badge-delivered {
            background-color: green;
        }

        .order-actions {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .filter-section {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .filter-section input,
            .filter-section select,
            .bulk-actions button {
                flex: 1 1 100%;
                margin: 10px 0;
                max-width: 100%;
                width: 100%;
            }

            .bulk-actions {
                flex-direction: column;
                gap: 10px;
            }

            .order-card {
                flex-direction: column;
            }

            .order-card img {
                margin-bottom: 10px;
            }

            .order-details {
                text-align: center;
            }

            .order-actions {
                flex-direction: column;
                gap: 10px;
            }

            .badge {
                margin-bottom: 5px;
            }
        }

        @media (max-width: 480px) {
            .order-card img {
                max-width: 80px;
            }

            .order-details {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    <div class="d-flex">
        @include('admin.sidebar')
        <div class="container">
            <h1>შეკვეთების მენეჯმენტი</h1>
            <div class="filter-section">
                <form action="{{ url('view_orders') }}" method="GET">
                    <input type="text" name="name" placeholder="კლიენტის სახელი" id="filter-name" value="{{ Request::input('name') }}">
                    <select name="status" id="filter-status">
                        <option value="">ყველა სტატუსი</option>
                        <option value="თქვენი შეკვეთა მუშავდება" {{ Request::input('status') == 'თქვენი შეკვეთა მუშავდება' ? 'selected' : '' }}>თქვენი შეკვეთა მუშავდება</option>
                        <option value="on the way" {{ Request::input('status') == 'on the way' ? 'selected' : '' }}>გზაშია</option>
                        <option value="delivered" {{ Request::input('status') == 'delivered' ? 'selected' : '' }}>მიტანილია</option>
                        <option value="saved" {{ Request::input('status') == 'saved' ? 'selected' : '' }}>გადადება</option>
                    </select>
                    <div class="bulk-actions">
                        <button type="submit" class="btn btn-secondary">ფილტრაცია</button>
                    </div>
                </form>
                <button class="btn btn-success" id="export-csv" onclick="window.location='{{ route('export.excel') }}'">
                    Excel<i class="fa-light fa-file-excel ml-2" style="color: #ffffff;"></i>
                </button>
        </div>
        @foreach ($data as $order)
            <div class="order-card">
                <img src="/products/{{ $order->product->images->first()->image }}" alt="Product Image">
                <div class="order-details">
                    <p><strong>კლიენტის სახელი:</strong> {{ $order->name }}</p>
                    <p><strong>ნივთი სახელი:</strong> {{ $order->product->title }}</p>
                    <p><strong>მისამართი:</strong> <input type="text" class="editable-input"
                            value="{{ $order->rec_address }}" style="border:none; background: transparent;"></p>
                    <p><strong>საკონტაქტო ნომერი:</strong> <input type="text" class="editable-input"
                            value="{{ $order->phone }}" style="border:none; background: transparent;"></p>
                    <p><strong>რაოდენობა:</strong> {{ $order->quantity }}</p>
                    <p><strong>სრული ფასი:</strong> {{ $order->total_price }}</p>
                    <p><strong>შეკვეთა შექმნილია:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <span
                        class="badge
                        @if ($order->status == 'in progress' || $order->status == 'თქვენი შეკვეთა მუშავდება') badge-in-progress
                        @elseif($order->status == 'on the way' || $order->status == 'გზაშია!') badge-on-the-way
                        @elseif($order->status == 'saved' || $order->status == 'გადადება!') badge-saved
                        @else badge-delivered @endif">
                        @if ($order->status == 'in progress' || $order->status == 'თქვენი შეკვეთა მუშავდება')
                            <span class="status-in-progress">{{ $order->status }}</span>
                        @elseif($order->status == 'on the way' || $order->status == 'გზაშია!')
                            <span class="status-on-the-way">
                                <i class="fa-solid fa-truck"></i> გზაშია!
                            </span>
                        @elseif($order->status == 'saved' || $order->status == 'გადადება!')
                            <span class="status-saved">
                                <i class="fa-solid fa-box-circle-check" style="color: #ffffff;"></i> გადადება!
                            </span>
                        @else
                            <span class="status-delivered">
                                <i class="fa-solid fa-box-open"></i> მიტანილია!
                            </span>
                        @endif
                    </span>
                </div>
                <div class="order-actions">
                    <a href="{{ url('on_the_way', $order->id) }}" class="btn btn-danger">გზაშია</a>
                    <a href="{{ url('delivered', $order->id) }}" class="btn btn-success">მიტანილია</a>
                    <a href="{{ url('saved', $order->id) }}" class="btn btn-info">გადადება</a>
                    <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-primary">PDF</a>
                    <a href="{{ url('send_invoice', $order->id) }}" class="btn btn-error">ინვოისის გაგზავნა</a>
                    <button class="btn btn-light" onclick="confirmCancel({{ $order->id }})">გაუქმება</button>
                </div>
            </div>
        @endforeach
    </div>
    </div>
    {{ $data->links() }}
    <script>
        function confirmCancel(orderId) {
            if (confirm('დარწმუნებული ხარ ამ შეკვეთის გაუქმება გინდა ?')) {
                window.location.href = `/cancel_order/${orderId}`;
            }
        }
    </script>
    @include('admin.js')
</body>

</html>
