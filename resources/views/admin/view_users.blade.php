<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Table Styling */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #fff;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            padding: 0.75rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody td {
            padding: 0.75rem;
            border-top: 1px solid #dee2e6;
        }

        .table tbody tr:nth-child(even) {
            background-color: #2c2f33;
        }

        /* Responsive Table Styling */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            /* Adds scroll for mobile devices */
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on iOS */
        }

        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #343a40;
            border-radius: 10px;
        }

        /* Button Styling */
        .btn {
            font-size: 0.9rem;
            padding: 0.4rem 0.7rem;
            border-radius: 4px;
        }

        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            .page-content {
                padding: 10px;
            }

            .table th,
            .table td {
                font-size: 0.9rem;
                padding: 0.5rem;
            }

            h2 {
                font-size: 1.5rem;
                text-align: center;
                margin-bottom: 1rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }

            .alert {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {

            .table th,
            .table td {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .btn {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }

            .alert {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="container">

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Admins Table -->
                    <h2 class="mt-2 text-white text-center">ადმინები</h2>
                    <div class="table-responsive">
                        <table class="mt-3 table table-striped text-white">
                            <thead>
                                <tr>
                                    <th>სახელი</th>
                                    <th>მეილი</th>
                                    <th>როლი</th>
                                    <th>ტელეფონი</th>
                                    <th>მოქმედებები</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->usertype }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>
                                            <a href="{{ url('edit_user', $admin->id) }}"
                                                class="btn btn-warning btn-sm">რედაქტირება</a>
                                            <form action="{{ url('delete_user', $admin->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('დარწმუნებული ხარ რომ ამ ადმინის წაშლა გინდა?')">წაშლა</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Admin Pagination -->
                    {{ $admins->links() }}

                    <!-- Users Table -->
                    <h2 class="mt-4 text-white text-center">კლიენტები</h2>
                    <div class="table-responsive">
                        <table class="mt-3 table table-striped text-white">
                            <thead>
                                <tr>
                                    <th>სახელი</th>
                                    <th>მეილი</th>
                                    <th>როლი</th>
                                    <th>ტელეფონი</th>
                                    <th>მისამართი</th>
                                    <th>მოქმედებები</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->usertype }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <a href="{{ url('edit_user', $user->id) }}"
                                                class="btn btn-warning btn-sm">რედაქტირება</a>
                                            <form action="{{ url('delete_user', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('დარწმუნებული ხარ რომ ამ კლიენტის წაშლა გინდა?')">წაშლა</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- User Pagination -->
                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
