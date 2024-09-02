<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="{{asset('/admincss/img/avatar-6.jpg')}}" alt="..."
                    class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h5">Mark Stephen</h1>
                <p>Web Designer</p>
            </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <span class="heading">ძირითადი</span>
        <ul class="list-unstyled">
            <li class="active"><a href="#"> <i class="icon-home"></i>მთავარი </a></li>
            <li>
              <a href="{{url('view_category')}}"> <i class="icon-grid"></i>
              კატეგორია </a>
            </li>

            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-windows"></i>პროდუქტი</a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_product')}}">დაამატე პროდუქცია</a></li>
                    <li><a href="{{url('view_product')}}">ყველა პროდუქცია</a></li>
                </ul>
            </li>
        </ul>
    </nav>
