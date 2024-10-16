@if (Auth::check() && Auth::user()->usertype === 'admin')
    <h2 class="h5 no-margin-bottom heading-mobile">გამარჯობა, {{ Auth::user()->name }}</h2>
@endif
</div>
</div>
<section class="no-padding-top no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3 d-flex">
        <a href="{{ url('view_users') }}" class="text-decoration-none statistic-block block flex-fill">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="fa-light fa-user" style="color: #70777d;"></i></div><strong>მომხმარებლები</strong>
            </div>
            <div class="number dashtext-1">{{ $user }}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{ $user / 10 }}%" aria-valuenow="{{ $user }}" aria-valuemin="0" aria-valuemax="{{ $user }}" class="progress-bar progress-bar-template dashbg-1"></div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3 d-flex">
        <a href="{{ url('view_product') }}" class="text-decoration-none statistic-block block flex-fill">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="fa-light fa-brush" style="color: #70777d;"></i></div><strong>პროდუქცია</strong>
            </div>
            <div class="number dashtext-2">{{ $product }}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{ $product / 10 }}%" aria-valuenow="{{ $product }}" aria-valuemin="0" aria-valuemax="{{ $product }}" class="progress-bar progress-bar-template dashbg-2"></div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3 d-flex">
        <a href="{{ url('view_orders') }}" class="text-decoration-none statistic-block block flex-fill">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="fa-light fa-cart-shopping" style="color: #70777d;"></i></div><strong>შეკვეთები</strong>
            </div>
            <div class="number dashtext-3">{{ $order }}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{ $order / 10 }}%" aria-valuenow="{{ $order }}" aria-valuemin="0" aria-valuemax="{{ $order }}" class="progress-bar progress-bar-template dashbg-3"></div>
          </div>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-md-3 d-flex">
        <a href="{{ url('view_orders') }}" class="statistic-block block flex-fill">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="fa-solid fa-box-circle-check"  style="color: #70777d;"></i></div><strong>გადანახული შეკვეთები</strong>
            </div>
            <div class="number dashtext-4">{{ $delivered }}</div>
          </div>
          <div class="progress progress-template">
            <div role="progressbar" style="width: {{ $delivered / 10 }}%" aria-valuenow="{{ $delivered }}" aria-valuemin="0" aria-valuemax="{{ $delivered }}" class="progress-bar progress-bar-template dashbg-4"></div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
<footer class="footer">
  <div class="footer__block block no-margin-bottom">
    <div class="container-fluid text-center">
      <p class="no-margin-bottom">2024 &copy; Abstrage.</p>
    </div>
  </div>
</footer>
