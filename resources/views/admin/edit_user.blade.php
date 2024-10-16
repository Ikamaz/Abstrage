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
                <div class="container">
                    <h1>იუზერის რედაქტირება</h1>

                    <form action="{{ url('update_user', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">სახელი</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">მეილი</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="usertype">იუზერის ტიპი</label>
                            <input type="text" name="usertype" class="form-control" value="{{ $user->usertype }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">იუზერის რედაქტირება</button>
                        <a href="{{ url('view_users') }}" class="btn btn-secondary">გაუქმება</a>
                    </form>
                </div>
    @include('admin.js')
</body>

</html>
