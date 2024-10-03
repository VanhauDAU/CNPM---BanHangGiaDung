@extends('layouts.client')
@section('title')
    {{ Auth::user()->ho_ten }} - {{$title}}
@endsection

@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-3">
                @include('clients.blocks.categoriesUser')
            </div>
            <div class="col-md-9 mx-auto">
                <div class="col-md-7 user-details mt-5" style="margin: 0 auto;">
                    <h5 class="mb-4 text-uppercase font-weight-bold running-text text-center">Địa chỉ</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
    <style>
        .user-info img {
        border: 3px solid #ddd;
        padding: 5px;
    }

    .user-details h5 {
        margin-bottom: 20px;
    }

    .list-group-item {
        padding: 15px 20px;
    }
    .user-details h5 {
        color: #333; 
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px; 
    }

    .list-group-item {
        border: 1px solid #ddd; 
        border-radius: 5px; 
        margin-bottom: 10px;
        transition: background-color 0.3s; 
    }

    .btn-link {
        color: #007bff; 
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-link i {
        margin-right: 5px;
        color: transparent;
    }
    .btn-link:hover i {
        color: #007bff;
    }

    .btn-link:hover {
        text-decoration: none; 
        color: #0056b3;
        transition: color 0.3s;
    }

    .list-group-item {
        border: 1px solid #ddd; 
        border-radius: 5px; 
        margin-bottom: 10px;
        transition: background-color 0.3s; 
        position: relative; /* Để thêm hiệu ứng */
    }

    .list-group-item:hover {
        /* background-color: #f1f1f1; */
        opacity: 0.7;
    }

    .list-group-item:hover .btn-link {
        color: #0056b3; /* Đổi màu thẻ liên kết khi hover vào item */
    }
    </style>
@endsection
