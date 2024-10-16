<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: 'BPG', sans-serif;
            background-color: #f5f5f5;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
        }

        .progress {
            height: 20px;
            border-radius: 10px;
        }

        .progress-bar {
            transition: width 0.4s ease;
        }

        .table {
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        img {
            border-radius: 8px;
            max-width: 80px;
        }

        .badge {
            font-size: 14px;
            padding: 5px 10px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 15px;
                background-color: #fff;
            }

            .table td {
                display: block;
                text-align: right;
                font-size: 14px;
            }

            .table td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }

            img {
                width: 100%;
                max-width: 100px;
            }
        }

        .order-status {
            padding: 0.5em 1em;
            border-radius: 0.25rem;
            color: #fff;
            font-weight: bold;
            display: inline-block;
        }

        .status-processing {
            background-color: #ffc107;
        }

        .status-shipped {
            background-color: #17a2b8;
        }

        .status-delivered {
            background-color: #28a745;
        }

        .status-unknown {
            background-color: #6c757d;
        }
    </style>

</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')

    <!-- Hero Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Order Details -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">გადანახული ნივთები</h5>
                    </div>
                    <div class="card-body">
                        <!-- Order Progress -->
                        {{-- <div class="mb-4">
                            <h6>შეკვეთის სტატუსი</h6>
                            <div class="progress">
                                <div class="progress-bar
                                    @if ($order->status == 'Processing') bg-warning
                                    @elseif($order->status == 'Shipped') bg-info
                                    @elseif($order->status == 'Delivered') bg-success
                                    @else bg-secondary @endif"
                                    role="progressbar"
                                    style="width: @if ($order->status == 'Processing') 25%
                                    @elseif($order->status == 'Shipped') 50%
                                    @elseif($order->status == 'Delivered') 100%
                                    @else 10% @endif">
                                    {{ ucfirst($order->status) }}
                                </div>
                            </div>
                        </div> --}}

                        <div class="order-products">
                            <h6 class="mb-3">თქვენი გადანახული პროდუქცია</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ფოტო სურათი</th>
                                            <th>პროდუქციის სახელი</th>
                                            <th>ფასი</th>
                                            <th>კოდი</th>
                                            <th>სტატუსი</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $order)
                                            <tr>
                                                <td data-label="ფოტო სურათი">
                                                    <img src="/products/{{ $order->product->images->first()->image ?? '/default-image.jpg' }}"
                                                        alt="Product Image">
                                                </td>
                                                <td data-label="პროდუქციის დასახელება">{{ $order->product->title }}</td>
                                                <td data-label="ფასი">{{ $order->product->price }} ₾</td>
                                                <td data-label="კოდი">{{ $order->product->code }}</td>
                                                <td data-label="სტატუსი">
                                                    <div
                                                        class="order-status
                                                    @if ($order->status == 'თქვენი შეკვეთა მუშავდება') status-processing
                                                    @elseif($order->status == 'on the way')
                                                        status-shipped
                                                    @elseif($order->status == 'delivered')
                                                        status-delivered
                                                    @else
                                                        status-unknown @endif">
                                                        @if ($order->status == 'თქვენი შეკვეთა მუშავდება')
                                                            <span>თქვენი შეკვეთა მუშავდება</span>
                                                        @elseif($order->status == 'on the way')
                                                            <span> გზაშია!</span>
                                                        @elseif($order->status == 'saved')
                                                            <span><i class="fa-solid fa-box-circle-check" style="color: #ffffff;"></i> გადანახულია!</span>
                                                        @elseif($order->status == 'delivered')
                                                            <span>მიტანილია</span>
                                                        @else
                                                            <span>Unknown Status</span>
                                                        @endif
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')

    @include('home.js')
</body>

</html>
