<div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
            <div class="title">
                @if (Auth::check() && Auth::user()->usertype === 'admin')
                    <h1 class="h4">გამარჯობა, {{ Auth::user()->name }}</h1>
                @endif
            </div>
        </div>
        <span class="heading">ატრიბუტები</span>
        <ul class="list-unstyled">
            <li><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>მთავარი </a></li>
            <li>
                <a href="{{ url('view_category') }}"> <i class="icon-grid"></i>
                    კატეგორია </a>
            </li>

            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-windows"></i>პროდუქცია</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ url('add_product') }}">დაამატე პროდუქცია</a></li>
                    <li><a href="{{ url('view_product') }}">ყველა პროდუქცია</a></li>
                    <li>
                        <a href="{{ url('view_orders') }}">შეკვეთები</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
