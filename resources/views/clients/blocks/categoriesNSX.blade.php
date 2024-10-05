<!-- Danh mục sản phẩm -->

<div class="col-lg-3 categories mt-1 p-2" style="background-color: white; border-radius: 15px">
    <a href="">
        <div class="logo-brand bg-white mx-2 p-2 text-center" style="border-radius: 15px">
            <h5 class="text-uppercase border-bottom pb-1">THƯƠNG HIỆU</h5>
            <img src="{{asset('storage/brands/img/'.$brand->logo)}}" alt="LOGO NSX"  width="200px" style="object-fit: contain">
        </div>
    </a>
    <ul class="list-group">
        
        <li class="list-group-item">
            <a href="{{ route('home.products.index') }}" class="category-link d-flex" style="font-weight:700">
                <h1 style="width: 22px; opacity:0; height:5px; margin-right: 10px;">hi</h1>
                    TÌM THEO CHUYÊN MỤC ({{CountChuyenMucNSX($brand->id_danh_muc,$brand->maNSX)}}) 
            </a>
        </li>
        @if(!empty(getAllChuyenMucNSX($slug)))
            @foreach(getAllChuyenMucNSX($slug) as $item)
                <li class="list-group-item">
                    <a href="{{ route('home.products.sanpham_id_id_id', [$item->slugDm,$item->slugCm,$item->slugNSX]) }}" class="category-link d-flex">
                        {{$item->ten_chuyen_muc}} {{$item->ten_NSX}} ({{CountSanPhamCM($item->maNSX,$item->id_chuyen_muc)}})
                        <i class="fa-solid fa-angles-right icon-submenu"></i>
                    </a>
                </li>
            @endforeach
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