<!-- Danh mục sản phẩm -->
<div class="col-lg-3 categories mt-3">
    <h4 class="mb-4">
        <i class="fas fa-bars"></i> Danh Mục Sản Phẩm
    </h4>
    <ul class="list-group">
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
                               
                                    <li class="listChuyenMuc"><a href="{{ route('home.products.sanpham_id_id', [$item->slug, $category->slug]) }}">{{ $category->ten_chuyen_muc }} ({{getAllProductCM($category->id_chuyen_muc)}} sp)</a></li>
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
                                        <li class="listChuyenMuc"><a href="{{ route('home.products.sanpham_id_id', [$item->id_danh_muc, $category->id_chuyen_muc]) }}">{{ $category->ten_chuyen_muc }}</a></li>
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
                                        <li class="listChuyenMuc"><a href="{{ route('home.products.sanpham_id_id', [$item->id_danh_muc, $category->id_chuyen_muc]) }}">{{ $category->ten_chuyen_muc }}</a></li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </ul>                
            </li>
            
            @endforeach
            <li class="list-group-item text-center">
                <a href="{{ route('home.products.sanpham_id', $item->id_danh_muc) }}" class="category-link text-danger text-center" >
                    Xem tất cả danh mục
                </a>
            </li>
        @endif
    </ul>
    
</div>

@section('stylesheet')
<style>
    .category-link {
    /* position: relative; */
    display: block;
    padding: 10px; 
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s;
}

.category-link:hover {
    background-color: #e2e6ea;
    color: #007bff; 
    border: 1px solid #ccc;
}
</style>

@endsection