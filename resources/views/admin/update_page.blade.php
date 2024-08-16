<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label
        {
            display: inline-block;
            width: 200px;
            padding: 20px;
            font-size: 18px !important;
            color: white !important;
        }

        input[type="text"]
        {
            width: 300px;
            height: 60px;
        }

        textarea
        {
            width: 450px;
            height: 100px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h1 style="color: white">პროდუქციის რედაქტირება</h1>

                <div class="div_deg">
                    <form action="{{url('edit_product',$data->id)}}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div>
                            <label>კოდი</label>
                            <input type="text" name="code" value="{{$data->code}}">
                        </div>

                        <div>
                            <label>სათაური</label>
                            <input type="text" name="title" value="{{$data->title}}">
                        </div>

                        <div>
                            <label>აღწერა</label>
                            <textarea name="description">{{$data->description}}</textarea>
                        </div>

                        <div>
                            <label>ფასი</label>
                            <input type="number" name="price" value="{{$data->price}}">
                        </div>

                        <div>
                            <label>რაოდენობა</label>
                            <input type="number" name="qty" value="{{$data->quantity}}">
                        </div>

                        <div>
                            <label>კატეგორია</label>
                            <select name="category" required>
                                <option value="{{$data->category}}">{{$data->category}}</option>

                                @foreach($category as $category)

                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label>მიმდინარე ფოტო</label>
                            <img width="150" src="/products/{{$data->image}}" alt="image">
                        </div>

                        <div>
                            <label>ახალი ფოტო</label>
                            <input type="file" name="image">
                        </div>

                        <div>
                            <input class="btn btn-success" type="submit" value="რედაქტირება">
                        </div>

                    </form>


                </div>


            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
