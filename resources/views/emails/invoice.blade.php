@php
    $statusTranslations = [
        'saved' => 'გადანახულია',
        'delivered' => 'მიტანილია',
        'on the way' => 'გზაშია',
    ];

    $translatedStatus = $statusTranslations[$order->status] ?? $order->status;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically */
        }

        .invoice-container {
            max-width: 600px; /* Compact design */
            width: 100%;
            background-color: #ffffff;
            padding: 30px; /* Spacious feel */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-size: 14px; /* Base font size */
        }

        .header, .footer {
            text-align: center; /* Centered text */
        }

        .header {
            border-bottom: 2px solid #eee; /* Emphasis border */
            padding-bottom: 15px;
            margin-bottom: 25px; /* Margin for separation */
        }

        .company-logo img {
            width: 120px; /* Adjusted logo size */
        }

        .logo {
            text-decoration: none;
            font-size: 28px; /* Balanced font size */
            font-weight: bold;
            color: #333;
        }

        .order-info {
            text-align: right;
        }

        .order-info h2 {
            margin: 0;
            font-size: 18px; /* Visible heading */
            color: #333;
        }

        .product-info {
            display: flex;
            align-items: center; /* Vertical centering */
            margin-bottom: 20px; /* Margin below product info */
        }

        .product-image img {
            width: 120px; /* Smaller image size */
            border-radius: 5px;
            border: 1px solid #ddd; /* Light border */
        }

        .product-details {
            margin-left: 15px; /* Space between image and text */
            flex: 1; /* Remaining space */
        }

        .product-details h3 {
            margin: 0;
            font-size: 16px; /* Consistent heading size */
            color: #333;
        }

        .footer {
            padding-top: 15px;
            border-top: 2px solid #eee; /* Footer border */
            color: #777;
            font-size: 12px; /* Smaller footer text */
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="header">
            <div class="company-logo">
                <p class="logo">ABSTRAGE</p>
            </div>
            <div class="order-info">
                <h2>ინვოისი #{{ $order->id }}</h2>
                <p><strong>თარიღი:</strong> {{ date('F j, Y', strtotime($order->created_at)) }}</p>
            </div>
        </div>

        <div class="product-info">
            <div class="product-image">
                {{-- <img src="{{ asset('products/' . $order->product->images->first()->image) }}" alt="Product Image"> --}}
            </div>
            <div class="product-details">
                <p><strong>თქვენი სახელი:</strong> {{ $order->name }}</p>
                <h3>{{ $order->product->title }}</h3>
                <p><strong>ფასი:</strong> ${{ number_format($order->product->price, 2) }}</p>
                <p><strong>თქვენი პროდუქცია:</strong> {{ $translatedStatus }}</p>
                <p></p>
            </div>
        </div>

        <div class="footer">
            <p>მადლობა რომ ირჩევთ აბსტრაჟს!</p>
            <p><strong>Abstrage</strong> | 89 Vazha-Pshavela Ave, Tbilisi | +995 574 65 22 11 | <a href="http://www.Abstrage.ge">www.Abstrage.ge</a></p>
        </div>
    </div>

</body>
</html>
