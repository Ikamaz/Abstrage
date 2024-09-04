<nav>
    <a href="{{ url('/dashboard') }}" class="logo">ABSTRAGE</a>

    <div id="burger" class="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="nav-links">
        <div class="nav-product">
            <a href="decoration.html">დეკორი</a>
            <a href="gallery.html">გალერეა</a>
            <a href="contact.html">კონტაქტი</a>
        </div>

        @if (Route::has('login'))
            @auth
                <div class="header-actions">
                    <form method="POST" action="{{ route('logout') }}" style="padding: 10px;">
                        @csrf
                        <input type="submit" class="logout-btn" value="გასვლა">
                    </form>
                    <div class="cart">
                        <a href="{{url('mycart')}}" class="cart-text">კალათა {{$count}}</a>
                    </div>
                </div>
            @else
                <div class="auth-links">
                    <a href="{{ url('/register') }}">რეგისტრაცია</a>
                    <a href="{{ url('/login') }}">ავტორიზაცია</a>
                </div>
            @endauth
        @endif
    </div>
</nav>
