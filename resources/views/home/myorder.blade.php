<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        /* Full height to allow flexbox layout */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            display: flex;
            flex-direction: column;
            font-family: 'BPG', sans-serif;
            background-color: #f5f5f5;
        }

        .page-wrapper {
            background-color: #f5f5f5;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            /* Allow the container to grow */
            display: flex;
            flex-direction: column;
            /* Stack child elements vertically */
        }

        .card {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
        }

        .card-header h5 {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
        }

        .order-products h6 {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
        }

        .progress {
            height: 20px;
            border-radius: 10px;
        }

        .table {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            margin-top: 20px;
        }

        .table th,
        .table td {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            text-align: center;
            vertical-align: middle;
        }

        img {
            border-radius: 8px;
            max-width: 80px;
        }

        .badge {
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
            font-size: 14px;
            padding: 5px 10px;
        }

        /* Mobile responsiveness */
        @media (max-width: 1024px) {
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

            .order-status {
                padding: 0.2em;
                font-size: 12px;
            }
        }

        .order-status {
            padding: 0.2em 1em;
            border-radius: 0.25rem;
            color: #fff;
            font-weight: bold;
            display: inline-block;
        }

        .status-processing {
            background-color: #ffc107;
        }

        .status-shipped {
            background-color: #f00000;
        }


        .status-saved {
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
    <!-- Page Wrapper for Flexbox layout -->
    <div class="page-wrapper">
        <!-- Navigation Bar -->
        @include('home.header')

        <!-- Hero Section -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <!-- Order Details -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">გადადებული ნივთები</h5>
                        </div>
                        <div class="card-body">
                            <div class="order-products">
                                <h6 class="mb-3">თქვენი გადადებული პროდუქცია</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ნივთის ფოტო</th>
                                                <th>პროდუქციის სახელი</th>
                                                <th>ფასი</th>
                                                <th>რაოდენობა</th>
                                                <th>კოდი</th>
                                                <th>სტატუსი</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalPrice = 0; @endphp
                                            @foreach ($order as $order)
                                                <tr>
                                                    <td data-label="ფოტო">
                                                        <a href="/product_details/{{ $order->product->id }}">
                                                            <img src="/products/{{ $order->product->images->first()->image ?? '/default-image.jpg' }}"
                                                                alt="Product Image">
                                                        </a>
                                                    </td>
                                                    <td data-label="პროდუქცია">{{ $order->product->title }}</td>
                                                    <td data-label="ფასი" class="price-wrapper">
                                                        @if ($order->product->discount_price)
                                                            <div class="price-container">
                                                                <p class="original-price">₾{{ $order->product->price }}
                                                                </p>
                                                                <p class="discounted-price">
                                                                    ₾{{ $order->product->discount_price }}</p>
                                                            </div>
                                                        @else
                                                            <p class="price">₾{{  $order->product->price }}</p>
                                                        @endif
                                                    </td>
                                                    <td data-label="რაოდენობა">{{ $order->quantity }}</td>
                                                    <td data-label="კოდი">{{ $order->product->code }}</td>
                                                    <td data-label="სტატუსი">
                                                        <div
                                                            class="order-status
                                                            @if ($order->status == 'თქვენი შეკვეთა მუშავდება') status-processing
                                                            @elseif($order->status == 'on the way')
                                                                status-shipped
                                                            @elseif($order->status == 'delivered')
                                                                status-delivered
                                                            @elseif($order->status == 'saved')
                                                                status-saved
                                                            @else
                                                                status-unknown @endif">
                                                            @if ($order->status == 'თქვენი შეკვეთა მუშავდება')
                                                                <span>შეკვეთა მუშავდება</span>
                                                            @elseif($order->status == 'on the way')
                                                                <span>გზაშია!</span>
                                                            @elseif($order->status == 'saved')
                                                                <span><i class="fa-solid fa-box-circle-check"
                                                                        style="color: #ffffff;"></i> გადადებულია!</span>
                                                            @elseif($order->status == 'delivered')
                                                                <span>მიტანილია</span>
                                                            @else
                                                                <span>Unknown Status</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $productPrice = $order->product->discount_price ?: $order->product->price;
                                                    $totalPrice += $productPrice * $order->quantity;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" style="text-align: right;"><strong>ჯამური
                                                        ფასი:</strong></td>
                                                <td>{{ $totalPrice }} ₾</td>
                                            </tr>
                                        </tfoot>
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
    </div>

    @include('home.js')
</body>

</html>
