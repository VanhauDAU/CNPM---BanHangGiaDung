<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg shadow-sm py-3 fixed-top">
    <div class="container">
        <div class="row_navbar w-100 d-flex justify-cotent-center align-items-center">
            <a href="{{route('home.index')}}">
                <div class="logo">
                    <img src="{{asset('assets/general/img/logoShop.png')}}" alt="Logo" class="img-fluid">
                </div>
            </a>
            <form id="frmsearch" class="text-center" action="" title="Tìm kiếm sản phẩm" method="get" data-gtm-form-interact-id="0">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" tabindex="-1" id="txtQuery" class="txtQuery search-txt txtsearch has-mic ac_input" autocomplete="off" size="40" value="" title="Nhập từ khóa liên quan đến sản phẩm" placeholder="Bạn cần tìm kiếm sản phẩm gì?" oninvalid="this.setCustomValidity('Nhập từ khóa liên quan đến sản phẩm')" required="" data-gtm-form-interact-field-id="0">
                <a class="btnClear" style="display: none;" id="btnClear"></a>
                <div class="iconSearch"></div>
                <div class="btnSearch" id="FindSubmit">
                    <input type="submit" value="Tìm kiếm" id="btnFindSearch">
                </div>
            </form>
            <div class="navbar_general">
                <div class="dropdown ms-3 text-center">
                    <a href="#" class="btn user-dropdown-btn" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> <span> 
                            @if(!empty(Auth::user()))
                                {{Auth::user()->ho_ten}}
                            @else
                            Tài khoản
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu user dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                        @if(empty(Auth::user()))
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Tra cứu đơn hàng</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Lịch sử mua hàng</a></li>
                        @else
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Tra cứu đơn hàng</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Lịch sử mua hàng</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{route('admin.dashboard')}}">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </ul>
                </div>
                <div class="dropdown text-center">
                    <a href="{{Route('home.gio-hang')}}" class="btn ms-3 rounded-pill dropdown-toggle" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i> Giỏ Hàng (0)
                    </a>
                    <div class="dropdown-menu p-4" aria-labelledby="cartDropdown" style="left: -100px; top: 36px;border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-width: 500px;">
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
                <a href="{{route('home.products.index')}}"  class="huongdan">
                    <div>
                        <i class="fa-solid fa-warehouse"></i>
                        Sản Phẩm
                    </div>
                </a>
                <a href="{{route('home.lien-he')}}" class="huongdan">
                    <div class="">
                        <i class="fa-solid fa-address-book"></i>
                        Liên hệ
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>
</header>
