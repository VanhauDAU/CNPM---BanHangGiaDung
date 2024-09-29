@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content-clients')
<main>
    <div class="container-contact container" style="margin-top:100px;margin-bottom: 50px">
        <div class="title-contact">
            <div class="body-title">
                <h2 class="title running-text">Liên hệ</h2>
                <div class="dieuhuong">
                    <a href="{{route('home.index')}}" class="dashboard">Trang chủ</a>
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="#!">Liên hệ</a>
                </div>
            </div>
        </div>

        <div class="row body-contact">
            <!-- Form liên hệ -->
            <div class="col-md-6">
                <div class="content-form">
                    <div class="social-list mb-4">
                        <div class="social-item d-flex">
                            <i class="fa-solid fa-location-arrow d-flex align-items-center"></i>
                            <p class="desc mb-0 ms-3">566 Núi Thành, Hoà Cường Nam, Hải Châu, Đà Nẵng, Việt Nam</p>
                        </div>
                        <div class="social-item d-flex align-items-center">
                            <i class="fa-solid fa-phone d-flex align-items-center"></i>
                            <a href="tel:0777464347">
                                <p class="desc mb-0 ms-3">0777464347</p>
                            </a>
                        </div>
                        <div class="social-item d-flex ">
                            <i class="fa-solid fa-envelope d-flex align-items-center"></i>
                            <a href="mailto:levanhaum@gmail.com">
                                <p class="desc mb-0 ms-3">levanhau.laravel@gmail.com</p>
                            </a>
                        </div>
                    </div>
                    <div class="form-contact">
                        <h2 class="text-form">Liên hệ với chúng tôi</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger" id="error-message">
                                Vui lòng kiểm tra lại dữ liệu
                            </div>
                        @endif
                        <form action="{{-- route('home.lien-he') --}}" method="post" >
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="ho_ten" placeholder="Họ và tên" value="{{old('ho_ten')}}">
                                @error('ho_ten')
                                    <span style="color:red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                @error('ho_ten')
                                    <span style="color:red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="tel" class="form-control" name="so_dien_thoai" placeholder="Số điện thoại" value="{{old('so_dien_thoai')}}">
                                @error('so_dien_thoai')
                                    <span style="color:red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <textarea name="noi_dung" class="form-control" rows="5" placeholder="Nội dung"value="{{old('noi_dung')}}"></textarea>
                                @error('noi_dung')
                                    <span style="color:red;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="btn-contact">
                                <button type="submit" class="btn btn-primary" name="btn-submit">Gửi liên hệ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Thành công!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                </script>
            @endif
            <!-- Google Map -->
            <div class="col-md-6">
                <div class="content-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.6411086925605!2d108.2220601!3d16.0321875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219ee4fe80ec5%3A0x6be9981175dc8deb!2zNTY2IE7DumkgVGjDoG5oLCBIb8OgIEPGsOG7nW5nIE5hbSwgSOG6o2kgQ2jDonUsIMSQw6AgTuG6tW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1711782325666!5m2!1svi!2s"
                            width="100%" height="450" style="border:0; border-radius: 20px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>                
            </div>
        </div>

        <!-- Đăng ký nhận tin -->
        <div class="register mt-5">
            <div class="main-content">
                <div class="body-register">
                    <h2>Đăng ký nhận tin khuyến mãi</h2>
                    <form action="">
                        <div class="form-email d-flex">
                            <input type="email" class="form-control me-2" placeholder="Nhập email của bạn">
                            <button class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection