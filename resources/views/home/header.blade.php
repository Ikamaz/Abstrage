<nav>
    <a href="{{ url('/dashboard') }}" class="logo">ABSTRAGE</a>

    <div id="burger" class="burger">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div class="nav-links">
      <div class="nav-product">
        <a href="{{ url('/all_products') }}">ყველა პროდუქცია</a>
        <a href="{{url('product_gallery')}}">გალერეა</a>
        <a href="{{url('/contact')}}">კონტაქტი</a>
      </div>

      @if (Route::has('login'))
        @auth
          <div class="header-actions">
            <div class="cart">
              <a href="{{ url('mycart') }}" class="cart-text">კალათა {{$count}}</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="padding: 10px;">
              @csrf
              <input type="submit" class="btn btn-outline-dark" value="გასვლა">
            </form>
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
