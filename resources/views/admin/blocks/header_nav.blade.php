<div class="header_nav d-flex justify-content-between align-items-center p-3 bg-light border-bottom mb-3" style="max-height: 60px">
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary me-2" id="toggle-sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h5 class="mb-0">Trang Quản Trị</h5>
    </div>
    <div class="d-flex align-items-center">
        <button class="btn btn-outline-info me-3">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger">3</span>
        </button>
        <button class="btn btn-outline-danger">
            <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Đăng Xuất
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </button>
    </div>
</div>
