<div class="user-info" style="position: sticky; top: 10px; /* Điều chỉnh khoảng cách từ đỉnh khi cuộn */">
    <div class="text-center mb-3 d-flex align-items-center gap-3">
        <img src="{{ Auth::user()->anh }}" alt="User Avatar" class="img-fluid rounded-circle" width="70">
        <h4 class="mt-2">{{ Auth::user()->ho_ten }}</h4>
    </div>
    <div class="list-group">
        <a href="{{route('home.info-user')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.info-user') || request()->routeIs('home.info-user.edit') ? 'active' : '' }}">Thông tin tài khoản</a>
        <a href="{{route('home.info-user-address')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.info-user-address') ? 'active' : '' }}">Địa chỉ</a>
        <a href="#" class="list-group-item list-group-item-action ">Lịch sử mua hàng</a>
        <a href="#" class="list-group-item list-group-item-action ">Sản phẩm đã xem</a>
        <a href="#" class="list-group-item list-group-item-action ">Đánh giá của tôi</a>
        <a href="#" class="list-group-item list-group-item-action ">Tra cứu hóa đơn</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>