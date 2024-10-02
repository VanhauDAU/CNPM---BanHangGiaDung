@extends('layouts.client')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('content-clients')
    <div class="main-posts">
        <div class="container mt-1" style="padding: 70px 0px 0px;"> 
            <div class="row">
                <div class="title-header text-center">
                    <h1 class="running-text fs-2">DANH SÁCH BÀI VIẾT</h1>
                </div>
                @if(!empty($Post))
                    @foreach($Post as $item)
                        <div class="col-md-3">
                            <a href="#">
                                <div class="post-item border rounded p-3"style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                    <div class="img-post text-center ">
                                        <img src="https://cdnphoto.dantri.com.vn/FFb5drFbUNYVFWKGcnNG4Hz2NtA=/thumb_w/1920/2024/10/02/z58688653718681b7356f12f3b8301f20a778cfe40adc3-1727832481422.jpg" alt=""
                                    style="max-width: 260px" class="rounded">
                                    </div>
                                    <div class="title-post">
                                        <h1 style="font-size: 20px" class="mt-2">Tiêu đề bài viết</h1>
                                    </div>
                                    <div class="content-post">
                                        <h3 style="font-size: 14px">Nội dung bài viết...</h3>
                                    </div>
                                    <div class="time-created">
                                        <h6 style="font-size: 13px">Thời gian đăng: <mark>02/10/2024</mark></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('stylesheet')
    <style>
        
        
    </style>

@endsection
