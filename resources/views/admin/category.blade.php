<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        input[type='text']
        {
            width: 400px;
            height: 50px;
        }

        .div_design
        {
          display: flex;
          align-items: center;
          justify-content: center;
          margin-top: 60px;
        }
        .table_deg
        {
          text-align: center;
          margin: auto;
          border: 2px solid red;
          margin-top: 50px;
        }
        th
        {
          background-color: red;
            color: black;
            font-size: 20px;
            font-weight: bold;
            padding: 15px
        }

        td
        {
          border: 1px solid red;
          text-align: center;
          color: white;
          padding: 10px;
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

              <h1 style="color: white">კატეგორიის დამატება</h1>

              <div class="div_design">

                <form action="{{url('add_category')}}" method="post">

                  @csrf

                    <div>
                        <input type="text" name="category">
                        <input class="btn btn-primary" type="submit" value="დაამატე კატეგორია">
                    </div>
                </form>
              </div>

              <div>
                <table class="table_deg">
                  <tr>
                    <th>კატეგორიის სახელი</th>

                    <th>რედაქტირება</th>

                    <th>წაშლა</th>
                  </tr>

                  @foreach($data as $data)
                  <tr>
                    <td>{{$data->category_name}}</td>
                    <td>
                      <a class="btn btn-success" href="{{url('edit_category', $data->id)}}">რედაქტირება</a>
                    </td>
                    <td>
                      <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category',$data->id )}}">წაშლა</a>
                    </td>
                  </tr>

                  @endforeach

                </table>
              </div>

            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
