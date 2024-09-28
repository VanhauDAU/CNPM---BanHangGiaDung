<nav class="navbar-default navbar-static-side" id="navbar" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="" src="{{asset('assets/general/img/logoShop.png')}}" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="{{route('admin.info')}}">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{--Auth::user()->ho_ten--}}</strong>
                         </span> <span class="text-muted text-xs block">
                            {{-- Auth::user()->maCV == 1 ? 'Giám Đốc' : (Auth::user()->maCV == 2 ? 'Quản Lý' : 'Nhân Viên') --}}

                            <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('admin.logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng Xuất</a>
                        </li>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="/admin"><i class="fa fa-th-large"></i> <span class="nav-label">Trang Chủ</span></a>
            </li>
            <li>
                <a href="/admin/quan-ly-san-pham"><i class="fa fa-desktop"></i> <span class="nav-label">QL Sản Phẩm</span></a>
            </li>
            <li>
                <a href="/admin/quan-ly-nguoi-dung"><i class="fa-solid fa-person"></i> <span class="nav-label">QL Người Dùng</span>{{--<span class="fa arrow"></span>--}}</a>
                {{-- <ul class="nav nav-second-level collapse">
                    <li><a href="graph_flot.html">Flot Charts</a></li>
                    <li><a href="graph_morris.html">Morris.js Charts</a></li>
                    <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                    <li><a href="graph_chartjs.html">Chart.js</a></li>
                    <li><a href="graph_chartist.html">Chartist</a></li>
                    <li><a href="c3.html">c3 charts</a></li>
                    <li><a href="graph_peity.html">Peity Charts</a></li>
                    <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
                </ul> --}}
            </li>
            <li>
                <a href="/admin/quan-ly-hoa-don"><i class="fa fa-envelope"></i> <span class="nav-label">QL Hóa Đơn </span><span class="label label-warning pull-right">16/24</span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="mailbox.html">Inbox</a></li>
                    <li><a href="mail_detail.html">Email view</a></li>
                    <li><a href="mail_compose.html">Compose email</a></li>
                    <li><a href="email_template.html">Email templates</a></li>
                </ul>
            </li>
            <li>
                <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">QL Khuyến Mãi</span>  </a>
            </li>
            <li>
                <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">QL Giao Diện</span></a>
            </li>
            <li class="active">
                <a href="{{ route('admin.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-edit"></i> 
                    <span class="nav-label">Đăng Xuất</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

    </div>
</nav>