<!DOCTYPE html>
<html lang="en">

<head>

    @include('home.css')

</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')
    <!-- Cart Items -->
    <div class="main-container">
        <div class="cart-container">
            <h1>თქვენი კალათა</h1>
            <?php
            $value = 0;
            ?>

            @foreach ($cart as $cart)
                <div class="cart-item">
                    <img src="/products/{{ $cart->product->image }}" alt="Product">
                    <div class="item-details">
                        <h2>{{ $cart->product->title }}</h2>
                        <p>კოდი: {{ $cart->product->code }}</p>
                        <p>კატეგორია: {{ $cart->product->category }}</p>
                    </div>
                    <div class="item-quantity">
                        @if($cart->product->category === 'ნახატი')
                        <input type="hidden" name="quantity" value="1">
                    @else
                        <input type="number" name="quantity" value="1" min="1">
                    @endif
                    </div>

                    <div class="item-price">{{ $cart->product->price }} ლარი</div>
                    <div class="item-remove">
                        <a href="{{ url('delete_cart', $cart->id) }}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>

                <?php
                $value = $value + $cart->product->price;
                ?>
            @endforeach
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


                <div class="order-total">ჯამი: {{ $value }} ლ</div>

                <input type="submit" class="save-btn" value="გადანახვა">
            </form>
        </div>
    </div>
    <!-- Footer -->
    @include('home.success-message')

    @include('home.footer')


    @include('home.js')
</body>

</html>
