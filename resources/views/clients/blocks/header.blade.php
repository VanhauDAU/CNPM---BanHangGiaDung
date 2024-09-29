<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/general/img/logoShop_bl.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active text-uppercase" href="{{route('home.index')}}">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{route('home.products.index')}}">Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{route('home.lien-he')}}">Liên Hệ</a>
                </li>
            </ul>
            <!-- Shopping Cart Icon -->
            <div class="dropdown">
                <a href="{{Route('home.gio-hang')}}" class="btn btn-outline-primary ms-3 rounded-pill dropdown-toggle" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i> Giỏ Hàng (0)
                </a>
                <div class="dropdown-menu p-4" aria-labelledby="cartDropdown" style="position: absolute; left: -100px; top: 57px;border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-width: 500px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{-- url('san-pham/1') --}}" class="d-flex align-items-center text-decoration-none text-dark">
                                        <img src="{{asset('assets/general/img/login_sidebar.jpg')}}" alt="Sản phẩm 1" style="width: 50px; height: auto;" class="rounded me-3">
                                        
                                    </a>
                                </td>
                                <td>Sản phẩm 1</td>
                                <td>100.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row d-flex justify-content-between align-items-center mt-3">
                        <h5 class="col-6">Tổng tiền: <span>900.000đ</span></h5>
                        <a class="btn btn-primary col-4" href="{{Route('home.gio-hang')}}">Xem Giỏ Hàng</a>
                    </div>
                </div>
            </div>
            <!-- User Icon Dropdown -->
            <div class="dropdown ms-3">
                <a href="#" class="btn user-dropdown-btn" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i> <span> 
                        @if(!empty(Auth::user()))
                            {{Auth::user()->ho_ten}}
                        @else
                        Tài khoản
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                    @if(empty(Auth::user()))
                        <li><a class="dropdown-item user-dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                        <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                    @else
                        <li><a class="dropdown-item user-dropdown-item" href="#">Thông tin tài khoản</a></li>
                        <li><a class="dropdown-item user-dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </ul>
            </div>

        </div>
    </div>
</nav>

</header>
@section('stylsheet')
<style>
    .navbar{
        border:4px solid red;
        border-bottom-color: red;
    }
    .navbar.fixed-top {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 999; 
    }
    #userDropdown {
        font-size: 1.25rem;
        padding: 0.5rem 1rem;
    }


    .menu-giohang{
        position: relative;
    }
    .submenu-giohang {
        
    }
    
</style>
@endsection
@section('js')
  <script></script>
@endsection