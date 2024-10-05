<nav class="sidebar p-3" id="sidebar" style="min-width:240px">
    <div class="text-center mb-4">
        <a target="_blank" href="{{route('home.index')}}"><img src="{{asset('assets/general/img/logoShop_bl.png')}}" alt="Logo" class="img-fluid rounded-circle" width="80"></a>
        <h4 style="font-size: 15px;margin-top:15px;font-weight:600; text-transform:uppercase">Chào, {{Auth::user()->ho_ten}}</h4>
        <h5 style="font-size: 15px;font-weight:600; text-transform:uppercase">{{Auth::user()->Chucvu->ten_chuc_vu}}</h5>
    </div>
    <ul class="nav flex-column gap-4">
        <li class="nav-item">
            <a class="nav-link active" href="/admin">
                <i class="fas fa-th-large"></i> Trang Chủ
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="accountDropdown" data-bs-toggle="collapse" data-bs-target="#accountSubMenu" aria-expanded="false">
                <i class="fas fa-users"></i> QL Tài Khoản
                <i class="fas fa-chevron-down float-end" style="margin-top: 3px"></i>
            </a>
            <ul class="collapse" id="accountSubMenu">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.manage_user')}}">Xem - Sửa - Xóa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_user')}}">Thêm</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="productDropdown" data-bs-toggle="collapse" data-bs-target="#productSubMenu" aria-expanded="false">
                <i class="fas fa-box"></i> QL Sản Phẩm
                <i class="fas fa-chevron-down float-end" style="margin-top: 3px"></i>
            </a>
            <ul class="collapse" id="productSubMenu">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.manage_product')}}">Xem - Sửa - Xóa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_product')}}">Thêm Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_nsx')}}">Thêm Nhà Sản Xuất</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_dm')}}">Thêm Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{--route('getadd_user')--}}">Thêm Chuyên Mục</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="productDropdown" data-bs-toggle="collapse" data-bs-target="#postSubMenu" aria-expanded="false">
                <i class="fas fa-box"></i> QL Bài Viết
                <i class="fas fa-chevron-down float-end" style="margin-top: 3px"></i>
            </a>
            <ul class="collapse" id="postSubMenu">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.manage_post')}}">Xem - Sửa - Xóa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_post')}}">Thêm Bài Viết</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="commentDropdown" data-bs-toggle="collapse" data-bs-target="#commentSubMenu" aria-expanded="false">
                <i class="fa-solid fa-message swing"></i> QL Bình Luận
                <i class="fas fa-chevron-down float-end" style="margin-top: 3px"></i>
            </a>
            <ul class="collapse" id="commentSubMenu">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.manage_cmt')}}">Xem - Xóa</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" id="productDropdown" data-bs-toggle="collapse" data-bs-target="#promotionSubMenu" aria-expanded="false">
                <i class="fas fa-tags"></i> QL Khuyến Mãi
                <i class="fas fa-chevron-down float-end" style="margin-top: 3px"></i>
            </a>
            <ul class="collapse" id="promotionSubMenu">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.manage_post')}}">Xem - Sửa - Xóa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('getadd_post')}}">Thêm Khuyến Mãi</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/quan-ly-hoa-don">
                <i class="fas fa-receipt"></i> QL Hóa Đơn
            </a>
        </li>
    </ul>
</nav>
