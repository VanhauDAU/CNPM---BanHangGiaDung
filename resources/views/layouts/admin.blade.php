{{-- 
@if (Auth::check())
    <h3>Đã Đăng Nhập</h3>
@endif --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/general/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/general/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/general/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/general/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/general/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/general/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/general/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/general/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/general/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/general/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/general/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/general/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/general/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/general/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="{{asset('assets/admin/css/custom_adminDashboard.css')}}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar .nav-link {
            color: #333;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            border-radius: 0.5rem;
        }
        .content {
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 0.5rem;
            margin-bottom: 20px;
        }
        .nav-item i{
            min-width:25px;
        }
        .header_nav {
            background-color: #f8f9fa; /* Màu nền sáng */
            transition: all 1s ease; /* Hiệu ứng chuyển động mượt mà */
        }
        .sidebar{
            transition: all 3s ease;
        }
        .header_nav button {
            border: none;
            outline: none;
        }
        .title-top{
            font-size: 20px;
        }
    </style>
    @yield('stylesheet')
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    @include('admin.blocks.navbar_dashboard')
    <!-- Content -->
    <div class="content flex-grow-1 p-3">
        @include('admin.blocks.header_nav')
        @yield('content-admin')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('d-none'); // Thay đổi lớp CSS để ẩn hiện
        });

        // Hàm ẩn thông báo sau một khoảng thời gian nhất định
        window.onload = function() {
            setTimeout(function() {
                var errorMessage = document.getElementById('error-message');
                var successMessage = document.getElementById('success-message');

                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }

                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 3500); // Thời gian ẩn thông báo (5000 milliseconds = 5 giây)
        }
        
        function toggleNavbar() {
            // Lấy đối tượng của navbar
            var navbar = document.getElementById('navbar');
            //id của navbar: navbar
            // Kiểm tra và thay đổi trạng thái hiển thị của navbar
            if (navbar.style.display === "none" || navbar.style.display === "") {
                navbar.style.display = "block"; // Hiển thị navbar nếu đang ẩn
            } else {
                navbar.style.display = "none"; // Ẩn navbar nếu đang hiển thị
            }
        }
        </script>
        @yield('js')
        
</body>
</html>
