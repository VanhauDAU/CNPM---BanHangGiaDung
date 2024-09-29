@extends('layouts.admin')
@section('title')
    TRANG QUẢN TRỊ
@endsection
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="row g-3">
        <div class="col-lg-3 col-md-6">
            <div class="card item-thongke">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="badge bg-success">Tháng này</span>
                    <h5 class="mb-0">Thu Nhập</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="no-margins">0</h1>
                    <div class="stat-percent font-bold text-success">0% <i class="fa fa-bolt"></i></div>
                    <small>Tổng thu nhập</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card item-thongke">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="badge bg-info">Hàng Năm</span>
                    <h5 class="mb-0">Đơn Hàng</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="no-margins">0</h1>
                    <div class="stat-percent font-bold text-info">0% <i class="fa fa-level-up"></i></div>
                    <small>Đơn hàng mới</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card item-thongke">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary">Hôm nay</span>
                    <h5 class="mb-0">Lượng Truy Cập</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="no-margins">0</h1>
                    <div class="stat-percent font-bold text-navy">0% <i class="fa fa-level-up"></i></div>
                    <small>Lượng truy cập mới</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card item-thongke">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="badge bg-danger">Low value</span>
                    <h5 class="mb-0">Khách Hàng Liên Hệ</h5>
                </div>
                <div class="card-body text-center">
                    <h1 class="no-margins">{{$countContact}}</h1>
                    <div class="stat-percent font-bold text-danger">0% <i class="fa fa-level-down"></i></div>
                    <small>In first month</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Các phần quản trị khác -->
    <div class="row g-3 mt-4">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Biểu Đồ Thu Nhập Theo Tháng</h5>
                </div>
                <div class="card-body">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thống Kê Đơn Hàng</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('stylesheet')
    <style>
        .item-thongke {
            cursor: pointer;
            transition: all .5s ease;
        }
        .item-thongke:hover {
            translate: 0px -3px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, 
                        rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, 
                        rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const ctx1 = document.getElementById('incomeChart').getContext('2d');
        const incomeChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
                datasets: [{
                    label: 'Thu Nhập',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Đơn Hàng 1', 'Đơn Hàng 2', 'Đơn Hàng 3'],
                datasets: [{
                    label: 'Số Lượng Đơn Hàng',
                    data: [12, 19, 5],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    </script>
@endsection
