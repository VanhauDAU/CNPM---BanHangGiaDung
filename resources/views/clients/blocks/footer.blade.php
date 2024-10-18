<!-- ============================================== FOOTER ============================================== -->
<footer id="footer" class="footer bg-dark text-light p-4">
    <div class="container">
        <div class="row">
            <!-- Contact Us -->
            <div class="col-sm-6 col-md-3 mb-4">
                <h5 class="footer-title text-danger">Liên hệ với chúng tôi</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>Điện Phong - Điện Bàn - Quảng Nam</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone-alt me-2"></i>
                        <a href="tel:0777464347" class="text-light" style="text-decoration: none;">0777464347</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:levanhaum@gmail.com" class="text-light" style="text-decoration: none;">levanhaum@gmail.com</a>
                    </li>
                    <h5 class="footer-title text-danger mt-3">Theo dõi chúng tôi</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-google-plus-g"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-light" style="text-decoration: none;"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="col-sm-6 col-md-3 mb-4">
                <h5 class="footer-title text-danger">Dịch vụ khách hàng</h5>
                <ul class="list-unstyled">
                    @if(Auth::user())
                        <li style="margin-bottom: 20px;"><a href="{{route('home.info-user')}}" class="text-light" style="text-decoration: none;">Tài khoản của tôi</a></li>
                        <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Lịch sử đơn hàng</a></li>
                    @endif
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Câu hỏi thường gặp</a></li>
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Khuyến mãi</a></li>
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Trung tâm hỗ trợ</a></li>
                </ul>
            </div>
            <!-- Corporation -->
            <div class="col-sm-6 col-md-3 mb-4">
                <h5 class="footer-title text-danger">Công ty</h5>
                <ul class="list-unstyled">
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Về chúng tôi</a></li>
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Dịch vụ khách hàng</a></li>
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Công ty</a></li>
                    <li style="margin-bottom: 20px;"><a href="#" class="text-light" style="text-decoration: none;">Quan hệ nhà đầu tư</a></li>
                    <li><a href="#" class="text-light" style="text-decoration: none;">Tìm kiếm nâng cao</a></li>
                </ul>
            </div>
            

            <!-- Contact Form -->
            <div class="col-sm-6 col-md-3 mb-4">
                <h5 class="footer-title text-danger">Liên hệ với chúng tôi</h5>
                <form action="{{route('home.lien-he')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ho_ten" class="text-light">Tên của bạn:</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Họ và tên..." value="{{old('ho_ten')}}">
                        @error('ho_ten')
                                    <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-light">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email...">
                        @error('email')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="so_dien_thoai" class="text-light">Số điện thoại:</label>
                        <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="Số điện thoại...">
                        @error('so_dien_thoai')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="noi_dung" class="text-light">Tin nhắn:</label>
                        <textarea class="form-control" id="noi_dung" name="noi_dung" rows="3" placeholder="Nội dung liên hệ..."></textarea>
                        @error('noi_dung')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger mt-2 w-100">Gửi</button>
                </form>
                
            </div>
        </div>

        <hr class="bg-light mt-4">
    <div class="text-center py-3">
        <small>© {{ date('Y') }} by Le Van Hau - Đại học Kiến trúc Đà Nẵng.</small>
    </div>
</footer>
<!-- ============================================== FOOTER : END ============================================== -->
