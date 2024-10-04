@extends('layouts.client')

@section('title')
    {{-- {{$title}} --}}
@endsection

@section('content-clients')
    <div class="main-posts">
        <div class="container mt-1" style="padding: 70px 0px 0px;">
            <div class="row">
                <div class="title-header text-center mb-3">
                    <h1 class="running-text fs-5">DANH SÁCH BÀI VIẾT</h1>
                </div>

                <div class="row">
                    <div class="col-7">
                        @if(!empty($Post))
                            @php
                                $firstItem = $Post->first();    
                            @endphp
                            @if($firstItem)
                                <a href="{{route('home.get_bai_viet',$firstItem->slug)}}">
                                    <div class="post-item border rounded mb-3" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                        <div class="img-post text-center">
                                            <img src="{{ asset('storage/posts/img/'.$firstItem->anh_bia) }}" alt="" class="rounded" style="width: 100%; height: 450px">
                                        </div>
                                        <div class="content-bottom p-2">
                                            <div class="title-post">
                                                <h1 class="mt-2 fw-bold" style="font-size: 20px;">{{ $firstItem->tieu_de }}</h1>
                                            </div>
                                            <div class="content-post">
                                                <h3 style="font-size: 14px;">{!! \Illuminate\Support\Str::limit($firstItem->noi_dung, 300, '...') !!}</h3>
                                            </div>
                                            <div class="time-created">
                                                <h6 style="font-size: 13px;">Thời gian đăng: <mark>{{ $firstItem->created_at }}</mark></h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endif
                    </div>

                    <div class="col-5">
                        @if(!empty($Post))
                            @php
                                $otherPosts = $Post->slice(1, 5);
                            @endphp
                            @foreach($otherPosts as $itemList)
                                <a href="{{route('home.get_bai_viet',$itemList->slug)}}">
                                    <div class="PostsList col-12 mb-1 d-flex align-items-center">
                                        <div class="col-5">
                                            <img src="{{ asset('storage/posts/img/'.$itemList->anh_bia) }}" alt="" class="rounded" style="width: 100%; height: 130px; object-fix: cover;margin-right:10px">
                                        </div>
                                        <div class="col-7 ms-2">
                                            <div class="title-post">
                                                <h1 style="font-size: 16px;" class="mt-2 fw-bold">{!! \Illuminate\Support\Str::limit($itemList->tieu_de, 40, '...') !!}</h1>
                                            </div>
                                            <div class="content-post">
                                                <h3 style="font-size: 14px;">{!! \Illuminate\Support\Str::limit($itemList->noi_dung, 100, '...') !!}</h3>
                                            </div>
                                            <div class="time-created">
                                                <h6 style="font-size: 13px;">Thời gian đăng: <mark>{{ \Carbon\Carbon::parse($itemList->created_at)->format('d-m-Y H:i:s') }}</mark></h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div id="morePosts" class="row mt-3 d-flex" style="display: none;">
                    @if(!empty($Post))
                        @php
                            $remainingPosts = $Post->slice(5);
                        @endphp
                        @foreach($remainingPosts as $itemList)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <a href="#" class="text-decoration-none">
                                    <div class="PostsList d-flex flex-column position-relative shadow-sm rounded border" style="overflow: hidden; transition: transform 0.3s;">
                                        <div class="img-container position-relative">
                                            <img src="{{ asset('storage/posts/img/'.$itemList->anh_bia) }}" alt="" class="rounded-top" style="width: 100%; height: 200px; object-fit: cover;">
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">Mới</span>
                                        </div>
                                        <div class="p-3">
                                            <div class="title-post">
                                                <h5 class="mb-1" style="font-size: 16px;">{!! \Illuminate\Support\Str::limit($itemList->tieu_de, 40, '...') !!}</h5>
                                            </div>
                                            <div class="content-post mb-2">
                                                <p class="mb-0" style="font-size: 14px;">{!! \Illuminate\Support\Str::limit($itemList->noi_dung, 100, '...') !!}</p>
                                            </div>
                                            <div class="time-created">
                                                <small class="text-muted">Thời gian đăng: <mark>{{ \Carbon\Carbon::parse($itemList->created_at)->format('d-m-Y H:i:s') }}</mark></small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                
            </div>
        </div>
    </div>
@endsection

@section('stylesheet')
    <style>
        .post-item {
            transition: transform 0.2s;
        }

        .post-item:hover {
            transform: scale(1.02);
        }

        .PostsList {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .PostsList:hover {
            transform: translateY(-5px); 
            box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 12px; 
        }

        .img-container {
            position: relative;
        }

        .badge {
            z-index: 1;
        }

        .title-post h5 {
            font-weight: 600; 
        }

        .content-post p {
            margin-bottom: 0; 
        }

        .time-created {
            color: #6c757d; 
        }

    </style>
@endsection

@section('js')
@endsection

