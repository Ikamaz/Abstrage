<!DOCTYPE html>
<html lang="en">

<head>

    @include('home.css')

</head>

<body>
    <!-- Navigation Bar -->
    @include('home.header')
    <!-- Cart Items -->

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
                    <input type="number" value="1" min="1">
                </div>
                <div class="item-price">{{ $cart->product->price }} ლ</div>
                <div class="item-remove">
                    <a href="{{url('delete_cart',$cart->id)}}">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </div>

            <?php
                $value = $value + $cart->product->price;
            ?>
        @endforeach



        <div class="cart-summary">
            <div class="total-price">ჯამი: {{$value}}</div>
            <button class="checkout-btn">გადანახვა</button>
        </div>
    </div>
    <!-- Footer -->
    @include('home.footer')


    @include('home.js')
</body>

</html>
