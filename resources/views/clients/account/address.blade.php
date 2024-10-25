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
@section('stylesheetAccount')
<style>
    .main-posts{
        background-color: #F3F4F6;
    }
</style>
@endsection