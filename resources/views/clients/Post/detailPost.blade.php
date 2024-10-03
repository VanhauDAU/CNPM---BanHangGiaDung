@extends('layouts.client')
@section('title')
    {{ $Post->tieu_de }}
@endsection

@section('content-clients')
    <div class="main-posts">
        <div class="container mt-1" style="padding: 70px 0px 0px;">
            <a href="{{route('home.bai-viet')}}" class="btn btn-success">Quay Lại</a>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="card-header">
                            <h2>{{ $Post->tieu_de }}</h2> 
                        </div>
                        <div class="card-body">
                            <p><strong>Người đăng:</strong> {{ $Post->ho_ten }}</p>
                            <div class="time-post d-flex gap-4">
                                <p style="font-size:15px; color:green"><strong>Ngày đăng:</strong> {{ \Carbon\Carbon::parse($Post->created_at)->format('d/m/Y H:i:s') }}</p> 
                                @if($Post->updated_at == null)
                                    
                                @else
                                    <p style="font-size:15px ;color: green"><strong>Ngày chỉnh sửa:</strong> {{ \Carbon\Carbon::parse($Post->updated_at)->format('d/m/Y H:i:s') }}</p></div> 
                                @endif
                            </div>
                             <p>{!! $Post->noi_dung !!}</p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('stylesheet')
    <style>
        .card {
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        .card-body {
            padding: 20px;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.1rem;
        }
    </style>
@endsection
