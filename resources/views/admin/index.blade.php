<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                @include('admin.body')

            </div>
        </div>
    </div>
    @include('admin.js')
  </body>
</html>
