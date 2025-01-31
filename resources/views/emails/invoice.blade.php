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
    <title>ინვოისი</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .invoice-container {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header {
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .company-logo img {
            width: 120px;
        }

        .logo {
            text-decoration: none;
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .order-info {
            text-align: right;
        }

        .order-info h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .product-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-image img {
            width: 120px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .product-details {
            margin-left: 15px;
            flex: 1;
        }

        .product-details h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .footer {
            padding-top: 15px;
            border-top: 2px solid #eee;
            color: #777;
            font-size: 12px;
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
                <p><strong>თარიღი:</strong> {{ date('j', strtotime($order->created_at)) }} {{ ['იანვარი', 'თებერვალი', 'მარტი', 'აპრილი', 'მაისი', 'ივნისი', 'ივლისი', 'აგვისტო', 'სექტემბერი', 'ოქტომბერი', 'ნოემბერი', 'დეკემბერი'][date('n', strtotime($order->created_at)) - 1] }} {{ date('Y', strtotime($order->created_at)) }}</p>
            </div>
        </div>

        <div class="product-info">
            <div class="product-image">
                <div class="product-image">
                    @if ($order->product->images->isNotEmpty())
                        <img src="{{ $message->embed(public_path('products/' . $order->product->images->first()->image)) }}"
                            alt="Image">
                    @endif

                </div>
            </div>
            <div class="product-details">
                <p><strong>თქვენი სახელი :</strong> {{ $order->name }}</p>
                <h3>{{ $order->product->title }}</h3>
                <p><strong>ფასი : </strong> {{ number_format($order->product->price, 2) }} ₾</p>
                <p><strong>შეკვეთის სტატუსი :</strong> {{ $translatedStatus }}</p>
                <p></p>
            </div>
        </div>

        <div class="footer">
            <p>მადლობა რომ ირჩევთ აბსტრაჟს!</p>
            <p><strong>Abstrage</strong> | 89 Vazha-Pshavela Ave, Tbilisi | +995 574 65 22 11 | <a
                    href="http://www.Abstrage.ge">www.Abstrage.ge</a></p>
        </div>
    </div>

</body>

</html>
