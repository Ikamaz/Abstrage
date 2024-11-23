<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        body {

            background-color: #f5f5f5;
            margin: 0;
        }

        .main-container {
            display: flex;
            gap: 20px;
            padding: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cart-container {
            flex: 1;
            max-width: 900px;
            width: 100%;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        .image-container img {
            width: 100%;
            max-width: 150px;
            border-radius: 8px;
        }

        .item-details h2 {
            font-size: 18px;
            margin: 0;
        }

        .item-price {
            font-weight: bold;
        }

        .order-container {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
            color: #333;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #343a40;
            outline: none;
            background-color: #fff;
        }

        .order-total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            color: #343a40;
        }

        .save-btn {
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .save-btn:hover {
            background-color: #495057;
        }

        .save-btn:active {
            background-color: #343a40;
        }

        /* Increment/Decrement Button Styles */
        .quantity-btn {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 5px 10px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            color: #333;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .quantity-btn:hover {
            background-color: #343a40;
            border-color: #343a40;
            color: #fff;
        }

        .quantity-btn:active {
            background-color: #495057;
        }

        .item-quantity {
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
        }

        .item-quantity button {
            width: 40px;
            height: 40px;
        }

        .item-quantity input {
            width: 60px;
            text-align: center;
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
            height: 40px;
            margin: 0;
        }

        .item-quantity button,
        .item-quantity input {
            display: inline-block;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .image-container img {
                max-width: 100%;
                margin-bottom: 10px;
            }

            .item-details,
            .item-quantity,
            .item-price,
            .item-remove {
                width: 100%;
                text-align: left;
            }

            .order-container {
                width: 100%;
                padding: 15px;
            }

            .input-group label,
            .input-group input {
                width: 100%;
            }

            .save-btn {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    @include('home.header')

    <div class="main-container">
        <div class="cart-container">
            <h1>თქვენი კალათა</h1>
            <div id="cartItems">
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($cart as $cartItem)
                    <div class="cart-item">
                        @if ($cartItem->product->images->first())
                            <div class="image-container">
                                <img src="/products/{{ $cartItem->product->images->first()->image }}" alt="Product">
                            </div>
                        @else
                            <div class="image-container">
                                <img src="/images/default.png" alt="No Image Available">
                            </div>
                        @endif

                        <div class="item-details">
                            <h2>{{ $cartItem->product->title }}</h2>
                            <p>კოდი: {{ $cartItem->product->code }}</p>
                        </div>

                        <div class="item-quantity">
                            <form action="{{ url('update_cart', $cartItem->id) }}" method="POST">
                                @csrf
                                <button type="submit" name="action" value="decrement" class="quantity-btn">-</button>
                                <input type="text" name="quantity" value="{{ $cartItem->quantity }}" readonly>
                                <button type="submit" name="action" value="increment" class="quantity-btn">+</button>
                            </form>
                        </div>

                        <div class="price-wrapper">
                            @if ($cartItem->product->discount_price)
                                <div class="price-container">
                                    <p class="discounted-price">₾{{ $cartItem->product->discount_price }}</p>
                                    @php
                                        $itemTotal = $cartItem->product->discount_price * $cartItem->quantity;
                                    @endphp
                                </div>
                            @else
                                <p class="price">₾{{ $cartItem->product->price }}</p>
                                @php
                                    $itemTotal = $cartItem->product->price * $cartItem->quantity;
                                @endphp
                            @endif
                        </div>

                        <div class="item-remove">
                            <a href="{{ url('delete_cart', $cartItem->id) }}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    @php
                        $totalPrice += $itemTotal;
                    @endphp
                @endforeach
            </div>
        </div>

        <div class="order-container">
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf
                <h2>პირადი ინფორმაცია</h2>

                <div class="input-group">
                    <label for="receiver-name">მიმღების სახელი</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="input-group">
                    <label for="address">მიმღების მისამართი</label>
                    <input type="text" id="address" name="address" value="{{ Auth::user()->address }}">
                </div>
                <div class="input-group">
                    <label for="phone">მიმღების ტელეფონის ნომერი</label>
                    <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <div class="order-total">ჯამი: <span id="totalPrice">{{ number_format($totalPrice, 2) }}</span> ლ</div>

                <input type="hidden" name="total_price" value="{{ $totalPrice }}">

                <input type="submit" class="save-btn" value="გადადება">
            </form>
        </div>
    </div>

    @include('home.success-message')
    @include('home.footer')
    @include('home.js')
</body>

</html>
