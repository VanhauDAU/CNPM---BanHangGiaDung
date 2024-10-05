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
            position: fixed;
            top: 0;  
            left: 0;
            margin-right: 250px;
            height: 100%;    /* Chiều cao 100% màn hình */
            width: 250px;    /* Chiều rộng cố định cho sidebar */
            background-color: #f8f9fa;
            padding-top: 20px; /* Khoảng cách từ đầu trang tới nội dung trong sidebar */
            transition: all 0.3s ease;
            z-index: 1000;   /* Đảm bảo sidebar nằm trên nội dung khác */
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
        #content {
            margin-left: 250px; /* Khoảng cách lề trái mặc định */
            width: calc(100% - 250px); /* Chiều rộng content tương ứng với navbar */
            transition: all 0.3s ease; /* Hiệu ứng chuyển động mượt */
            padding: 20px;
        }
        /* Khi sidebar ẩn */
        .sidebar-hidden .sidebar {
            width: 0;
            overflow: hidden;
        }
        .sidebar-hidden #content {
            margin-left: 0;
            width: 100%;
        }
        .text-sp-hover{
            color: black;
            text-decoration:none;
        }
        .text-sp-hover:hover{
            color: green;
        }
        .border-animation {
            position: relative;
            border-radius: 50%;
            border: 5px solid;
            border-image-slice: 1;
            animation: borderColorChange 3s linear infinite;
        }
        .border-animation1 {
            position: relative;
            border-radius: 50%;
            border: 2px solid;
            border-image-slice: 1;
            animation: borderColorChange 3s linear infinite;
        }

        @keyframes borderColorChange {
            0% {
                border-color: #ff6b6b;
            }
            25% {
                border-color: #ffcc00;
            }
            50% {
                border-color: #1dd1a1;
            }
            75% {
                border-color: #54a0ff;
            }
            100% {
                border-color: #ff6b6b;
            }
        }
    </style>
    @yield('stylesheet')
</head>
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="loginToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Bạn đã đăng nhập thành công!
        </div>
    </div>
</div>

<body>
<div class="d-flex">
    <!-- Sidebar -->
    @include('admin.blocks.navbar_dashboard')
    <!-- Content -->
    <div class="content flex-grow-1 p-3" id="content">
        @include('admin.blocks.header_nav')
        @yield('content-admin')
    </div>
</div>
@if (session('success'))
    <script>
        Swal.fire({
            title: "Thành công!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('d-none'); // Thay đổi lớp CSS để ẩn hiện
        });
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-hidden');
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
            }, 5500); // Thời gian ẩn thông báo (5000 milliseconds = 5 giây)
        }
        
        function toggleNavbar() {
            // Lấy đối tượng của navbar và content
            var navbar = document.getElementById('navbar');
            var content = document.getElementById('content');

            // Kiểm tra và thay đổi trạng thái hiển thị của navbar
            if (navbar.style.display === "none" || navbar.style.display === "") {
                navbar.style.display = "block"; // Hiển thị navbar nếu đang ẩn
                content.style.marginLeft = "250px"; // Đặt khoảng cách lề trái tương ứng với chiều rộng navbar
                content.style.width = "calc(100% - 250px)"; // Chiều rộng content điều chỉnh theo navbar
            } else {
                navbar.style.display = "none"; // Ẩn navbar nếu đang hiển thị
                content.style.marginLeft = "0"; // Không có lề trái khi navbar bị ẩn
                content.style.width = "100%"; // Chiều rộng content 100% khi navbar bị ẩn
            }
        }
        
        </script>
        
        <script>
            ClassicEditor
                .create( document.querySelector( '#mo_ta' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#noi_dung' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('mo_ta');
            CKEDITOR.replace('noi_dung');
            async function fetchChuyenMuc(id_danh_muc) {
            const maNSX = document.getElementById('maNSX').value;

            if (maNSX && id_danh_muc) {
                try {
                    const response = await fetch(`/fetch-chuyen-muc/${maNSX}/${id_danh_muc}`);
                    
                    // Kiểm tra xem phản hồi có phải là 404 không
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    
                    const chuyenMucs = await response.json();

                    const chuyenMucSelect = document.getElementById('id_chuyen_muc');
                    chuyenMucSelect.innerHTML = '<option value="">Chọn chuyên mục sản phẩm</option>'; // Reset the options

                    chuyenMucs.forEach(chuyenMuc => {
                        const option = document.createElement('option');
                        option.value = chuyenMuc.id_chuyen_muc; 
                        option.textContent = chuyenMuc.ten_chuyen_muc; // Thay thế bằng tên chuyên mục
                        chuyenMucSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error fetching chuyen muc:', error);
                }
            } else {
                // Nếu không có maNSX hoặc id_danh_muc thì reset select chuyên mục
                document.getElementById('id_chuyen_muc').innerHTML = '<option value="">Chọn chuyên mục sản phẩm</option>';
            }
        }

        function fetchDanhMuc(maNSX) {
            console.log("Fetching Danh Muc for maNSX: ", maNSX); 
            const danhMucSelect = document.getElementById('id_danh_muc');
            danhMucSelect.innerHTML = '<option value="">Chọn danh mục</option>'; 

            if (maNSX) {
                fetch(`/getDanhMuc/${maNSX}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Data fetched: ", data);

                        if (data.length === 0) {
                            const noOption = document.createElement('option');
                            noOption.value = "";
                            noOption.textContent = "Nhà sản xuất này không có danh mục nào"; 
                            danhMucSelect.appendChild(noOption);
                        } else {
                            // Nếu có danh mục, thêm chúng vào select
                            data.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id_danh_muc;
                                option.textContent = category.ten_danh_muc;
                                danhMucSelect.appendChild(option);
                            });
                        }

                        // Gọi fetchChuyenMuc khi danh mục thay đổi
                        danhMucSelect.onchange = function() {
                            fetchChuyenMuc(this.value); // Gọi hàm fetchChuyenMuc khi danh mục thay đổi
                        };
                    })
                    .catch(error => console.error('Lỗi:', error));
            } else {
                danhMucSelect.innerHTML = '<option value="">Chọn danh mục</option>';
            }
        }

        
        
    </script>
    
@yield('js')
        
</body>
</html>
