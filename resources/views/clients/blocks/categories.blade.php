<!-- Danh mục sản phẩm -->
<div class="col-lg-3">
    <h4 class="mb-4">
        <i class="fas fa-bars"></i> Danh Mục Sản Phẩm
    </h4>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('home.products.index') }}" class="category-link d-flex">
                <h1 style="width: 22px; opacity:0; height:5px; margin-right: 10px">hi</h1>Tất cả danh mục
            </a>
        </li>
        @if(!empty(getAllDanhMucSp()))
            @foreach(getAllDanhMucSp() as $item)
            <li class="list-group-item">
                <a href="{{ route('home.products.sanpham_id', $item->id_danh_muc) }}" class="category-link d-flex">
                    @if($item->icon==null)
                        <h1 style="width: 22px; opacity:0; height:5px; margin-right: 10px">hi</h1>
                    @else
                        <img src="{{$item->icon}}" alt="" style="width: 22px; margin-right: 10px">
                    @endif
                    {{$item->ten_danh_muc}}
                    <i class="fa-solid fa-angles-right icon-submenu"></i>
                </a>
    
                <ul class="sub-category">
                    <div class="row col-sm-12">
                        <div class="col-sm-4">
                            @php
                        // Kiểm tra nếu id_danh_muc không rỗng
                        $itemCategories = !empty($item->id_danh_muc) ? getChuyenMuc1($item->id_danh_muc) : [];
                        @endphp
                        @if(!empty($itemCategories) && count($itemCategories) > 0)
                            <div class="sub-category-container">
                                @foreach($itemCategories as $category)
                                    <li><a href="{{ route('home.products.sanpham_id_id', [$item->id_danh_muc, $category->id_chuyen_muc]) }}">{{ $category->ten_chuyen_muc }}</a></li>
                                @endforeach
                            </div>
                        @else
                            <h4 class="running-text">Không có chuyên mục nào</h4>
                        @endif
                        </div>
                        <div class="col-sm-4">
                            @php
                            // Kiểm tra nếu id_danh_muc không rỗng
                            $itemCategories = !empty($item->id_danh_muc) ? getChuyenMuc2($item->id_danh_muc) : [];
                            @endphp
                            @if(!empty($itemCategories) && count($itemCategories) > 0)
                                <div class="sub-category-container">
                                    @foreach($itemCategories as $category)
                                        <li><a href="{{ route('home.products.sanpham_id_id', [$item->id_danh_muc, $category->id_chuyen_muc]) }}">{{ $category->ten_chuyen_muc }}</a></li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-4">
                            @php
                            // Kiểm tra nếu id_danh_muc không rỗng
                            $itemCategories = !empty($item->id_danh_muc) ? getChuyenMuc3($item->id_danh_muc) : [];
                            @endphp
                            @if(!empty($itemCategories) && count($itemCategories) > 0)
                                <div class="sub-category-container">
                                    @foreach($itemCategories as $category)
                                        <li><a href="{{ route('home.products.sanpham_id_id', [$item->id_danh_muc, $category->id_chuyen_muc]) }}">{{ $category->ten_chuyen_muc }}</a></li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </ul>                
            </li>
            @endforeach
        @endif
    </ul>
    
</div>