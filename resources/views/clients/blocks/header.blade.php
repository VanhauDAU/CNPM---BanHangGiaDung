<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg shadow-sm py-3 fixed-top">
      <div class="container">
          <div class="row_navbar w-100 d-flex justify-content-center align-items-center">
              <a href="{{route('home.index')}}">
                  <div class="logo d-flex">
                        <img class="bee" src="{{asset('assets/general/img/bee.gif')}}" alt="">
                      <img src="{{asset('assets/general/img/logoShop.png')}}" alt="Logo" class="img-fluid me-4">
                  </div>
              </a>
              <form id="frmsearch" class="text-center" action="" title="Tìm kiếm sản phẩm" method="get">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input type="text" name="keyword" tabindex="-1" id="keyword" class="txtQuery search-txt txtsearch has-mic ac_input" autocomplete="off" size="40" title="Nhập từ khóa liên quan đến sản phẩm" placeholder="Tìm kiếm với {{CountSanPham()}} sản phẩm tại cửa hàng" required="">
                  <a class="btnClear" style="display: none;" id="btnClear"></a>
                  <div class="iconSearch"></div>
                  <div class="btnSearch" id="FindSubmit">
                      <input type="submit" value="Tìm kiếm" id="btnFindSearch">
                  </div>
              </form>
              <div class="navbar_general">
                  
                  <!-- Cart Dropdown -->
                  <div class="dropdown text-center">
                      <a href="{{Route('home.cart.view')}}" class="btn ms-3 rounded-pill dropdown-toggle" id="cartDropdown" data-bs-toggle="" aria-expanded="false">
                          <i class="fas fa-shopping-cart"></i> Giỏ Hàng @if(!empty(session('cart'))) 
                            ({{count(session('cart'))}}) @endif
                      </a>
                      <div class="dropdown-menu p-4" aria-labelledby="cartDropdown" style="left: -100px; top: 36px;border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-width: 500px;">
                          <table class="table table-hover">
                            @if(session('cart') && count(session('cart')) > 0)
                              <thead>
                                  <tr>
                                      <th scope="col">Ảnh</th>
                                      <th scope="col">Tên Sản Phẩm</th>
                                      <th scope="col">Giá</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forEach(session('cart') as $id =>$item)
                                <a href="{{-- url('san-pham/1') --}}" class="d-flex align-items-center text-decoration-none text-dark" >
                                  <tr>
                                      <td>
                                          <img src="{{asset('storage/products/img/'. $item['anh'])}}" alt="{{$item['anh']}}" style="width: 50px; height: auto;" class="rounded me-3">
                                      </td>
                                      <td>{{ \Illuminate\Support\Str::limit( $item['ten_san_pham'], 30)}}</td>
                                      <td>
                                        {{number_format($item['don_gia'],0,',','.')}}đ
                                    </td>
                                  </tr>
                                </a>

                                  @endforeach
                              </tbody>
                            @else
                              <h5>KHÔNG CÓ SẢN PHẨM NÀO TRONG GIỎ HÀNG</h5>
                            @endif
                          </table>
                          <div class="row d-flex justify-content-between align-items-center mt-3">
                            @if(session('cart') && count(session('cart')) > 0)
                            <h5 class="col-8">Tổng tiền: <span id="total-price" style="color: #28a745;">
                                {{ number_format(array_sum(array_map(function($item) { return $item['don_gia'] * $item['so_luong']; }, session('cart'))), 0, ',', '.') }} đ</span>
                            </h5>
                              <a class="btn btn-primary col-4" href="{{Route('home.cart.view')}}">Xem Giỏ Hàng</a>
                            @else
                                <a class="btn btn-primary col-12" href="{{Route('home.products.index')}}">Xem Thêm Sản Phẩm</a>
                            @endif
                          </div>
                      </div>
                  </div>
                  <a href="{{route('home.products.index')}}"  class="huongdan">
                      <div>
                          <i class="fa-solid fa-warehouse"></i>
                          Sản Phẩm
                      </div>
                  </a>
                  {{-- <a href="{{route('home.lien-he')}}" class="huongdan">
                      <div class="">
                          <i class="fa-solid fa-address-book"></i>
                          Liên hệ
                      </div>
                  </a> --}}
                  <!-- User Dropdown -->
                  <div class="dropdown ms-1 text-center">
                    <a href="#" class="btn user-dropdown-btn" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(!empty(Auth::user()))
                                @if(Auth::user()->provider =="google")
                                    <img src="{{Auth::user()->anh}}" alt="" style="width: 30px; height:30px; border-radius:50%">
                                @else
                                    <img src="{{asset('storage/users/img/'.Auth::user()->anh)}}" alt="" style="width: 30px; height:30px; border-radius:50%">
                                @endif
                            @else
                                <i class="fas fa-user"></i> <span>  
                            @endif        
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
                            <li><a class="dropdown-item user-dropdown-item" href="{{route('home.info-user')}}">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </ul>
                </div>
              </div>
          </div>
      </div>
  </nav>
  </header>
  
  <script>
      window.addEventListener('scroll', function() {
          const header = document.querySelector('.header-style-1');
          if (window.scrollY > 50) {
              header.classList.add('header-scrolled');
          } else {
              header.classList.remove('header-scrolled');
          }
      });
  </script>
  