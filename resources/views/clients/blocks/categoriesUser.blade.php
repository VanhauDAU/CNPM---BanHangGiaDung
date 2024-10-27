<div class="user-info" style="position: sticky; top: 10px; /* Điều chỉnh khoảng cách từ đỉnh khi cuộn */">
    <div class="text-center mb-3 d-flex align-items-center gap-3">
        @if(Auth::user()->provider == "google")
            <img src="{{ Auth::user()->anh }}" alt="User Avatar" class="img-fluid rounded-circle" width="70">
        @elseif(Auth::user()->provider == "account" && Auth::user()->anh != null)
            <img src="{{ asset('storage/users/img/' . Auth::user()->anh) }}" alt="User Avatar" class="img-fluid rounded-circle" width="70">
        @else
            <img src="https://www.mgp.net.au/wp-content/uploads/2023/05/150-1503945_transparent-user-png-default-user-image-png-png.png" alt="" width="70" class="rounded-circle">
        @endif

        <h4 class="mt-2">{{ Auth::user()->ho_ten }}</h4>
    </div>
    <div class="list-group">
        <a href="{{route('home.account.index')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.account.index') || request()->routeIs('home.info-user.edit') ? 'active' : '' }}">Thông tin tài khoản</a>
        <a href="{{route('home.account.info-user-address')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.account.info-user-address') ? 'active' : '' }}">Địa chỉ</a>
        <a href="{{route('home.account.myOrder')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.account.myOrder') ? 'active' : ''}}">Đơn hàng của tôi</a>
        <a href="#" class="list-group-item list-group-item-action ">Sản phẩm đã xem</a>
        <a href="#" class="list-group-item list-group-item-action ">Đánh giá của tôi</a>
        <a href="{{route('home.account.password-user.edit')}}" class="list-group-item list-group-item-action {{request()->routeIs('home.account.password-user.edit') ? 'active' : '' }}">Đổi mật khẩu</a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@section('stylesheet')
<style>
    .user-info img {
            border: 3px solid #ddd;
            padding: 5px;
        }

        .user-details h5 {
            margin-bottom: 20px;
        }

        .list-group-item {
            padding: 15px 20px;
        }
        .user-details h5 {
            color: #333; 
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px; 
        }

        .list-group-item {
            border: 1px solid #ddd; 
            border-radius: 5px; 
            margin-bottom: 10px;
            transition: background-color 0.3s; 
        }

        .btn-link {
            color: #007bff; 
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-link i {
            margin-right: 5px;
            color: transparent;
        }
        .btn-link:hover i {
            color: #007bff;
        }

        .btn-link:hover {
            text-decoration: none; 
            color: #0056b3;
            transition: color 0.3s;
        }

        .list-group-item {
            border: 1px solid #ddd; 
            border-radius: 5px; 
            margin-bottom: 10px;
            transition: background-color 0.3s; 
            position: relative;
        }
        .list-group-item.active {
            background-color: #FFB30D; /* Màu nền */
            color: white; /* Màu chữ */
            border-color: #FFB30D; /* Màu viền */
        }

</style>
@endsection