@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content-clients')
    <div class="container mt-1" style="padding: 60px 0px 0px; ">  
        <div class="main-brands p-2" style="background-color: #EEEEEE">
        {{-- đường dẫn --}}
        @if(!empty($brand))
            <div class="breadcrumb d-flex align-items-center" style="background-color: #EEEEEE">
                <a href="{{route('home.products.index')}}"><i class="fa-solid fa-house"></i></a>
                    <span class="separator">></span>
                    <a href="{{route('home.products.sanpham_id',$brand->slug)}}" class="breadcrumb-link">{{$brand->ten_NSX}}</a>
            </div> 
        @else
            <a href="{{route('home.products.index')}}"><i class="fa-solid fa-house"></i></a>
        @endif
        <div class="row pt-1 mx-2">
            @include('clients.blocks.categoriesNSX',['slug' => $brand->slug])
            <div class="col-9">
                <div class="list-img-nsx text-center">
                    <div class="img-item-nsx">
                        <img src="https://st.meta.vn/img/thumb.ashx/Data/image/2023/05/17/Banner-samsung-970x270.png" alt="" width="100%" class="rounded">
                    </div>
                    <div class="img-item-nsx">
                        <img src="https://st.meta.vn/img/thumb.ashx/Data/image/2023/04/05/Banner-dien-may-samsung-970x270.png" alt="" width="100%" class="rounded">
                    </div>
                </div>
                <div class="row mx-2 mt-2 fs-4 fw-bold d-flex">
                    <h4>{{$brand->ten_NSX}} <span style="font-size: 13px">({{CountSanPhamNSX($brand->maNSX)}} sản phẩm)</span></h4>
                </div>
                <div class="row list-chuyenmuc-nsx mx-2 d-flex gap-3 pt-2" style="overflow: scroll;overflow-x: hidden;">
                    @if(!empty($danhmucbrand))
                        @foreach($danhmucbrand as $item1)
                            <div class="col-2 text-center">
                                <a href="{{ route('home.products.sanpham_id_id_id', [$item1->slugDm, $item1->slug,$item1->slugNSX]) }}">
                                    <div class="rounded p-2 item-danhmuc-nsx" style="background-color: white; cursor: pointer; max-height: 120px;">
                                        <img src="{{ asset('storage/products/img/' . $item1->anh_cm) }}" alt="" style="width: 75px; min-height: 60px">
                                        <h6>{{ $item1->ten_chuyen_muc }}</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="container py-5">
                    <div class="text-center">
                      <img src="{{asset('storage/brands/img/'.$brand->logo)}}" class="wow animate__animated animate__fadeInDown" alt="Samsung Logo" width="200" />
                    </div>
                    <h2 class="wow animate__animated animate__zoomIn text-center fw-bold mt-4">
                      Giới Thiệu {{$brand->ten_NSX}}
                    </h2>
                    <p class="wow animate__animated animate__fadeInLeft fs-5 mt-3 text-center">
                        {{$brand->gioi_thieu}}
                    </p>
                    <div class="text-center mt-4">
                      <a href="#" class="btn btn-primary btn-lg wow animate__animated animate__bounceIn" data-wow-delay="0.3s">Tìm Hiểu Thêm</a>
                    </div>
                  </div>
                  
            </div>
            
        </div>
    </div>
@endsection

@section('stylesheet')
    <style>
    </style>

@endsection
