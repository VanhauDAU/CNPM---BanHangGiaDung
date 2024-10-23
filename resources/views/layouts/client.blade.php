
{{-- ====================================== --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- favicon --}}
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/general/favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/general/favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/general/favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/general/favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/general/favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/general/favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/general/favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/general/favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/general/favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/general/favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/general/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/general/favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/general/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('assets/general/favicon/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fontawesome--}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- gg font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    {{-- slick --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- sweetAlert2 --}}
    <!-- Animate.css -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/clients/css/custom_css.css')}}">
     <!-- Thêm Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <!-- Thêm WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- Custom CSS -->
    <style>
        *{
          padding: 0;
          margin: 0;
          box-shadow: border-box;
          font-family: "Open Sans", sans-serif;
        }
        a{
          color: black;
          text-decoration: none;
        }
        body{
         background: url('/assets/general/img/banner_background2.png');
          position: relative;
          background-color: #F3F3F3;
        }
        body::-webkit-scrollbar {
            width: 13px; 
        }

        body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #DA251C;
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .navbar .logo .bee{
            position: absolute;
            top:-13px;
            width: 130px;
            left: 80px;
        }
        .floating-buttons {
            position: fixed;
            left: -5px;
            bottom: 50%; 
            transform: translateY(50%);
            z-index: 1000; 
            padding: 5px;
            background-color: #CE1219;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .floating-buttons {
            position: fixed;
            left: 0;
            bottom: 50%; 
            transform: translateY(50%);
            z-index: 1000; 
            padding: 5px;
            background-color: #CE1219;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .button {
            display: block;
            margin: 10px 0;
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            transition: transform 0.3s, background-color 0.3s; /* Hiệu ứng chuyển động */
        }

        .button:hover {
            transform: scale(1.1); 
        }

        .button i {
            font-size: 24px; 
            color: white;
            transition: color 0.3s, transform 0.3s; 
        }

        .button:hover i {
            color: #007bff;
            transform: rotate(10deg); 
        }
        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(15deg);
            }
            50% {
                transform: rotate(-15deg);
            }
            75% {
                transform: rotate(15deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }

        .swing {
            animation: swing 1s infinite; /* Thay đổi thời gian nếu cần */
        }
    </style>
    @yield('stylesheet')
</head>

<body>
    @include('clients.blocks.header')
    <div class="floating-buttons">
        <a href="tel:123456789" class="button phone-button" title="Gọi điện">
            <i class="fas fa-phone-alt"></i>
        </a>
        <a href="{{route('home.bai-viet')}}" class="button messenger-button" title="Tin Tức">
            <i class="fa-solid fa-newspaper"></i>
        </a>
        <a href="{{route('home.post_lien-he')}}" class="button messenger-button" title="Khuyến Mãi">
            <i class="fa-solid fa-message"></i>
        </a>
    </div>
     
    {{-- chatBox --}}
    <div id="chatbox" class="chatbox">
        <div class="icon_chatbot">
            <img src="{{asset('assets/clients/images/icon_chatBot.png')}}" alt="" width="40px" class="chatbot-img">
        </div>
    </div>   
    <div class="social-info">
        <div class="social facebook">
            <a href="https://www.facebook.com/van.hau.1410" target="_blank"><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="social twitter">
            <a href="" target="_blank"><i class="fa-brands fa-twitter" style="color: black"></i></a>
        </div>
        <div class="social youtube">
            <a href="" target="_blank"><i class="fa-brands fa-youtube" style="color: red"></i></a>
        </div>
        <div class="social telegram">
            <a href="" target="_blank"><i class="fa-brands fa-telegram" style="color:#3AAFE1;"></i></a>
        </div>
    </div>
    <button id="scroll-to-top" style="display: none; position: fixed; bottom: 20px; right: 70px; z-index: 1000; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
        <i class="fa-solid fa-circle-up"></i>
    </button>
    
    @yield('content-clients')
    <div class="header-top">
        <img src="https://st.meta.vn/img/thumb.ashx/Data/2024/Thang10/10-10/Banner-10-10-1236x60.png" alt="" width="100%">
    </div>
    <!-- Footer -->
    @include('Clients.blocks.footer')
    @yield('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
        $('.product-list-home').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            prevArrow: '<button class="custom-prev">⟨</button>', 
            nextArrow: '<button class="custom-next">⟩</button>',
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            responsive: [
            {
                breakpoint: 768,
                settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 4
                }
            },
            {
                breakpoint: 480,
                settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
                }
            }
            ]
        });
        });
        $(document).ready(function(){
            $('.list-img-nsx').slick({
                prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                nextArrow: '<button type="button" class="slick-next">Next</button>',
            });
        });
        $('.product-image-list').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            prevArrow: '<button class="slick-prev-imgDetailProduct custom-prev bg-success"><i class="fa fa-arrow-left" style="color: black;"></i></button>',
            nextArrow: '<button class="slick-next-imgDetailProduct custom-next bg-success"><i class="fa fa-arrow-right" style="color: black;"></i></button>'
        });
        $('.ListDanhMucHot').slick({
            centerMode: true,
            centerPadding: '10px',
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            slidesToShow: 3,
            arrows: false,
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '20px',
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '20px',
                    slidesToShow: 1
                }
                }
            ]
            });
            $('.list-product-hot').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 6,
                slidesToScroll: 1,
                prevArrow: false, 
                nextArrow: false,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                ]
                });
                $('.listProductViewed').slick({
                    slidesToShow: 6,
                    slidesToScroll: 6
                    });

                    var filtered = false;

                    $('.js-filter').on('click', function(){
                    if (filtered === false) {
                        $('.filtering').slick('slickFilter',':even');
                        $(this).text('Unfilter Slides');
                        filtered = true;
                    } else {
                        $('.filtering').slick('slickUnfilter');
                        $(this).text('Filter Slides');
                        filtered = false;
                    }
                    });
            function showSlide(slider, index) {
                const slides = slider.querySelectorAll('.product-item-danhmuc');
                const totalSlides = slides.length;
                if (totalSlides === 0) return;

                // Điều chỉnh currentSlide
                if (index >= Math.ceil(totalSlides / 2)) {
                    index = Math.ceil(totalSlides / 2) - 1; 
                } else if (index < 0) {
                    index = 0;
                }
                slider.style.transform = 'translateX(' + (-index * (100 / 5)) + '%)'; 
            }

            // Hàm thay đổi slide
            function changeSlide(slider, direction) {
                const totalSlides = slider.querySelectorAll('.product-item-danhmuc').length;
                if (totalSlides === 0) return;
                const currentSlide = parseInt(slider.getAttribute('data-current-slide')) || 0; 

                const newSlide = currentSlide + direction * 2;
                slider.setAttribute('data-current-slide', newSlide);

                showSlide(slider, newSlide);
            }

            // Gán sự kiện cho các nút
            document.querySelectorAll('.slider-container').forEach(container => {
                const slider = container.querySelector('.slider');
                
                container.querySelector('.prev').addEventListener('click', function() {
                    changeSlide(slider, -1);
                });
                
                container.querySelector('.next').addEventListener('click', function() {
                    changeSlide(slider, 1);
                });
            });
            $(document).ready(function() {
                $(document).on('click', '.reply-btn', function() {
                    var commentId = $(this).data('comment-id');
                    // Hiển thị/ẩn form trả lời tương ứng với bình luận
                    console.log("Nhấn vào nút trả lời, ID bình luận: " + commentId);
                    $('#replyFormContainer_' + commentId).toggle();
                });
            });
            document.querySelectorAll('.reply-btn-con').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id') || this.getAttribute('data-reply-id');
                    const replyFormContainer = document.getElementById(`replyFormContainerCon_${commentId}`);
                    replyFormContainer.style.display = replyFormContainer.style.display === 'none' ? 'block' : 'none';
                });
            });
            $(document).ready(function() {
            $('#province').on('change', function() {
                var provinceID = $(this).val();
                if (provinceID) {
                    // Show loading message
                    $('#district').empty().append('<option>Loading...</option>');
                    $.ajax({
                        url: '/districts/' + provinceID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district').empty().append('<option value="">Chọn Huyện</option>');
                            $.each(data, function(key, value) {
                                $('#district').append('<option value="' + value.district_id + '">' + value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('#district').empty().append('<option>Không thể tải dữ liệu</option>');
                        }
                    });
                } else {
                    $('#district').empty();
                    $('#ward').empty();
                }
            });

            $('#district').on('change', function() {
                var districtID = $(this).val();
                if (districtID) {
                    // Show loading message
                    $('#ward').empty().append('<option>Loading...</option>');
                    $.ajax({
                        url: '/wards/' + districtID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward').empty().append('<option value="">Chọn Xã</option>');
                            $.each(data, function(key, value) {
                                $('#ward').append('<option value="' + value.wards_id + '">' + value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('#ward').empty().append('<option>Không thể tải dữ liệu</option>');
                        }
                    });
                } else {
                    $('#ward').empty();
                }
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- script của slick --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        const icons = document.querySelectorAll('.floating-buttons .button i');
        icons.forEach(icon => {
            icon.classList.add('swing');
        });
      function setActive(element, value) {
          var links = document.querySelectorAll('.quick_product a');
          links.forEach(function(link) {
              link.classList.remove('active');
          });
          element.classList.add('active');
          localStorage.setItem('activeLink', value);
      }
      window.onload = function() {
          var activeLink = localStorage.getItem('activeLink');
          if (activeLink) {
              var links = document.querySelectorAll('.quick_product a');
              links.forEach(function(link) {
                  if (link.textContent.trim() === activeLink) {
                      link.classList.add('active');
                  }
              });
          }
      }
            // script.js
        const images = [
            '/assets/general/img/banner_background1.png',
            '/assets/general/img/banner_background2.png',
            '/assets/general/img/banner_background3.png',
        ];

        let currentIndex = 0;
        function changeBackground() {
            currentIndex = (currentIndex + 1) % images.length; 
            document.body.style.backgroundImage = `url('${images[currentIndex]}')`;
        }
        setInterval(changeBackground, 6000);
        changeBackground();
        // Nút cuộn lên
        window.onscroll = function() {
            const button = document.getElementById("scroll-to-top");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                button.style.display = "block";
            } else {
                button.style.display = "none";
            }
        };
        document.getElementById("scroll-to-top").onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('toast'))
                var toastEl = document.getElementById('loginToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            @endif
        });
        new WOW().init()

        // Xử lý ẩn hiện danh mục

    </script>
</body>

</html>
