<!-- Danh mục sản phẩm -->
<div class="col-lg-3 categories">
    <h5 class="text-center text-warning" style="font-size:13px">
        @if(isset($weather) && !isset($weather['error']))
            <div class="weather-info">
                <p style="font-size: 15px">
                    Nhiệt độ: <strong>{{ $weather['main']['temp'] }}°C</strong>,
                    Độ ẩm: <strong>{{ $weather['main']['humidity'] }}%</strong>
                </p>
            </div>
        @else
            <p>Chúc bạn ngày {{now()->day}}/{{now()->month}} vui vẻ</p>
        @endif
    </h5>
    
    <div class="category-container">
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