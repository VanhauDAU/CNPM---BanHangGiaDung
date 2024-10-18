<!-- ============================================== HEADER ============================================== -->

<header class="header-style-1" id="header-style-1">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg shadow-sm py-3 fixed-top">
      <div class="container">
          <div class="row_navbar w-100 d-flex justify-content-center align-items-center">
              <a href="{{route('home.index')}}" id="playSoundLink">
                  <div class="logo d-flex">
                    <img class="bee" src="{{asset('assets/general/img/bee.gif')}}" alt="" style="left: -1px">
                        {{-- <audio id="sound" src="{{asset('storage/audio/wellcome.mp3')}}"></audio> --}}
                    <img src="{{asset('assets/general/img/logoShop.png')}}" alt="Logo" class="img-fluid me-4">
                  </div>
              </a>
              <form id="frmsearch" class="text-center rounded" action="" title="Tìm kiếm sản phẩm" method="get">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input type="text" name="keyword" tabindex="-1" id="keyword" class="txtQuery search-txt txtsearch has-mic ac_input" autocomplete="off" size="40" title="Nhập từ khóa liên quan đến sản phẩm" placeholder="Tìm kiếm với {{CountSanPham()}} sản phẩm tại cửa hàng" required="">
                  <a class="btnClear" style="display: none;" id="btnClear"></a>
                  <div class="iconSearch"></div>
                  <div class="btnSearch " id="FindSubmit">
                      <input type="submit" value="Tìm kiếm" id="btnFindSearch" class="rounded">
                  </div>
              </form>
              <div class="navbar_general">
                  <!-- Cart Dropdown -->
                  <div class="dropdown text-center">
                        <a href="{{Route('home.cart.index')}}" class="btn ms-3 rounded-pill dropdown-toggle" id="cartDropdown" data-bs-toggle="" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i> Giỏ Hàng ({{count(countCart())}})
                        </a>
                        @if(!empty(Auth::user()))
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
                                                <img src="{{--asset('storage/products/img/'. $item['anh'])}}" alt="{{$item['anh']--}}" style="width: 50px; height: auto;" class="rounded me-3">
                                            </td>
                                            <td>{{-- \Illuminate\Support\Str::limit( $item['ten_san_pham'], 30)--}}</td>
                                            <td>
                                                {{--number_format($item['don_gia'],0,',','.')--}}đ
                                            </td>
                                        </tr>
                                        </a>

                                        @endforeach
                                    </tbody>
                                    @else
                                    <h5>KHÔNG CÓ SẢN PHẨM NÀO TRONG GIỎ HÀNG</h5>
                                    @endif
                                </table>
                                <div class="row mt-3">
                                    @if(session('cart') && count(session('cart')) > 0)
                                    <h5 class="col-8">Tổng tiền: <span id="total-price" style="color: #28a745;">
                                        {{-- number_format(array_sum(array_map(function($item) { return $item['don_gia'] * $item['so_luong']; }, session('cart'))), 0, ',', '.') --}} đ</span>
                                    </h5>
                                    @else

                                    @endif
                                    
                                </div>
                                <div class="payment d-flex align-items-center justify-content-between">
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <a class="btn btn-warning col-12" href="{{Route('home.cart.index')}}">Xem Giỏ Hàng</a>
                                    @else
                                        <a class="btn btn-primary col-12" href="{{Route('home.products.index')}}">Xem Thêm Sản Phẩm</a>
                                    @endif
                                </div>
                                
                            </div>
                        @else
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
                                                <img src="{{--asset('storage/products/img/'. $item['anh'])--}}" alt="{{--$item['ten_san_pham']--}}" style="width: 50px; height: auto;" class="rounded me-3">
                                            </td>
                                            <td>{{-- \Illuminate\Support\Str::limit( $item['ten_san_pham'], 30)--}}</td>
                                            <td>
                                                {{--number_format($item['don_gia'],0,',','.')--}}đ
                                            </td>
                                        </tr>
                                        </a>

                                        @endforeach
                                    </tbody>
                                    @else
                                    <h5>KHÔNG CÓ SẢN PHẨM NÀO TRONG GIỎ HÀNG</h5>
                                    @endif
                                </table>
                                <div class="row mt-3">
                                    @if(session('cart') && count(session('cart')) > 0)
                                    <h5 class="col-8">Tổng tiền: <span id="total-price" style="color: #28a745;">
                                        {{-- number_format(array_sum(array_map(function($item) { return $item['don_gia'] * $item['so_luong']; }, session('cart'))), 0, ',', '.') --}} đ</span>
                                    </h5>
                                    @else

                                    @endif
                                    
                                </div>
                                <div class="payment d-flex align-items-center justify-content-between">
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <a class="btn btn-warning col-5" href="{{Route('home.cart.index')}}">Xem Giỏ Hàng</a>
                                        <a class="btn btn-primary col-5" href="{{Route('home.pay.index')}}">Thanh Toán</a>
                                    @else
                                        <a class="btn btn-primary col-12" href="{{Route('home.products.index')}}">Xem Thêm Sản Phẩm</a>
                                    @endif
                                </div>
                                
                            </div>
                        @endif
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
                            {{-- {{dd(Auth::user())}} --}}
                                @if(Auth::user()->provider =="google")
                                    <img src="{{Auth::user()->anh}}" alt="" style="width: 30px; height:30px; border-radius:50%">
                                @elseif(Auth::user()->anh == null)
                                    <img src="https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" alt="" style="width: 30px; height:30px; border-radius:50%">
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
                            
                        @else
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Tra cứu đơn hàng</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{route('home.info-user')}}">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </ul>
                </div>
                {{-- Lịch Sử Mua Hàng --}}
                <div class="history-buy">
                    <a href="" style="color:white">Lịch sử mua hàng</a>
                </div>
              </div>
          </div>
      </div>
  </nav>
</header>
<header class="header-style-2" id="header-style-2">
    <nav class="navbar navbar-expand-lg shadow-sm py-3 fixed-top"   style="background-color: #FF6B1A">
      <div class="container">
          <div class="row_navbar w-100 d-flex justify-content-center align-items-center">
            <div class="btn-category-show me-4 fs-3 p-2" style="color:white; cursor: pointer; display: flex; align-items: center; justify-content: center; border: 1px solid white; border-radius: 30px; background-color: rgba(255, 255, 255, 0.2); transition: background-color 0.3s;">
                <i class="fa-solid fa-list" style="margin-right: 5px;"></i><span style="font-size:15px">Danh Mục</span>
                <ul class="list-group" style="width: 250px">
                    <li class="list-group-item">
                        <a href="{{ route('home.products.index') }}" class="category-link d-flex">
                            <h1 style="width: 22px; opacity:0; height:5px; margin-right: 10px">hi</h1>
                            Tất cả danh mục ({{CountDanhMuc()}}) 
                        </a>
                    </li>
                    @if(!empty(getAllDanhMucSp()))
                        @foreach(getAllDanhMucSp() as $item)
                        <li class="list-group-item">
                            <a href="{{ route('home.products.sanpham_id', $item->slug) }}" class="category-link d-flex">
                                @if($item->icon == null)
                                    <h1 style="width: 22px; opacity:0; height:5px; margin-right: 10px">hi</h1>
                                @else
                                    <img src="{{$item->icon}}" alt="" style="width: 22px; margin-right: 10px">
                                @endif
                                {{$item->ten_danh_muc}}
                                <i class="fa-solid fa-angles-right icon-submenu"></i>
                            </a>
                
                            <ul class="sub-category">
                                <div class="row col-sm-12">
                                    @php
                                        $itemCategories = !empty($item->id_danh_muc) ? getChuyenMuc1($item->id_danh_muc) : [];
                                    @endphp
                                    @if(!empty($itemCategories) && count($itemCategories) > 0)
                                        <div class="sub-category-container">
                                            @foreach($itemCategories as $category)
                                                <li class="listChuyenMuc">
                                                    <a href="{{ route('home.products.sanpham_id_id', [$item->slug, $category->slugCm]) }}">
                                                        {{ $category->ten_chuyen_muc }} ({{ getAllProductCM($category->id_chuyen_muc) }} sp)
                                                    </a>
                                                </li>
                                            @endforeach
                                        </div>
                                    @else
                                        <h4 class="running-text">Không có chuyên mục nào</h4>
                                    @endif
                                </div>
                            </ul>
                        </li>
                        @endforeach
                        <li class="list-group-item text-center">
                            <a href="{{ route('home.products.sanpham_id', $item->id_danh_muc) }}" class="category-link text-danger text-center">
                                Xem tất cả danh mục
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
              <a href="{{route('home.index')}}" id="playSoundLink">
                  <div class="logo d-flex">
                    <img src="{{asset('assets/general/img/logoShop.png')}}" alt="Logo" class="img-fluid me-4">
                  </div>
              </a>
              <form id="frmsearch" class="text-center rounded" action="" title="Tìm kiếm sản phẩm" method="get">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input type="text" name="keyword" tabindex="-1" id="keyword" class="txtQuery search-txt txtsearch has-mic ac_input" autocomplete="off" size="40" title="Nhập từ khóa liên quan đến sản phẩm" placeholder="Tìm kiếm với {{CountSanPham()}} sản phẩm tại cửa hàng" required="">
                  <a class="btnClear" style="display: none;" id="btnClear"></a>
                  <div class="iconSearch"></div>
                  <div class="btnSearch " id="FindSubmit">
                      <input type="submit" value="Tìm kiếm" id="btnFindSearch" class="rounded">
                  </div>
              </form>
              <div class="navbar_general">
                  <!-- Cart Dropdown -->
                  <div class="dropdown text-center">
                      <a href="{{Route('home.cart.index')}}" class="btn ms-3 rounded-pill dropdown-toggle" id="cartDropdown" data-bs-toggle="" aria-expanded="false">
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
                                          <img src="{{--asset('storage/products/img/'. $item['anh'])--}}" alt="{{--$item['anh']--}}" style="width: 50px; height: auto;" class="rounded me-3">
                                      </td>
                                      <td>{{-- \Illuminate\Support\Str::limit( $item['ten_san_pham'], 30)--}}</td>
                                      <td>
                                        {{--number_format($item['don_gia'],0,',','.')--}}đ
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
                                {{-- number_format(array_sum(array_map(function($item) { return $item['don_gia'] * $item['so_luong']; }, session('cart'))), 0, ',', '.') --}} đ</span>
                            </h5>
                            @else
                            @endif
                          </div>
                          <div class="payment d-flex align-items-center justify-content-between">
                            @if(session('cart') && count(session('cart')) > 0)
                                <a class="btn btn-warning col-5" href="{{Route('home.cart.index')}}">Xem Giỏ Hàng</a>
                                <a class="btn btn-primary col-5" href="{{Route('home.pay.index')}}">Thanh Toán</a>
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
                            {{-- {{dd(Auth::user())}} --}}
                                @if(Auth::user()->provider =="google")
                                    <img src="{{Auth::user()->anh}}" alt="" style="width: 30px; height:30px; border-radius:50%">
                                @elseif(Auth::user()->anh == null)
                                    <img src="https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg" alt="" style="width: 30px; height:30px; border-radius:50%">
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
                            
                        @else
                            <li><a class="dropdown-item user-dropdown-item" href="{{ route('register') }}">Tra cứu đơn hàng</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{route('home.info-user')}}">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item user-dropdown-item" href="{{route('home.info-user')}}">Lịch sử mua hàng</a></li>
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
      document.addEventListener('DOMContentLoaded', function() {
        const header1 = document.getElementById('header-style-1');
        const header2 = document.getElementById('header-style-2');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 650) {
                header1.style.display = 'none';
                header2.style.display = 'block';
            } else {
                // Nếu ở đầu trang, hiện header và ẩn footer
                header1.style.display = 'block';
                header2.style.display = 'none';
            }
        });
    });
  </script>
  