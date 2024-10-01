
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
  {{-- sweetAlert2 --}}
  <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/clients/css/custom_css.css')}}">
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
        }
        .navbar .logo .bee{
            position: absolute;
            top:-13px;
            width: 130px;
            left: 80px;
        }
        </style>
    @yield('stylesheet')
</head>

<body>
  @include('clients.blocks.header')
    <div class="social-info">
        <div class="social zalo">
            <a href=""><i class="fa-brands fa-zalo" style="color:#3AAFE1;"></i></a>
        </div>
        <div class="social facebook">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="social twitter">
            <a href=""><i class="fa-brands fa-twitter" style="color: black"></i></a>
        </div>
        <div class="social youtube">
            <a href=""><i class="fa-brands fa-youtube" style="color: red"></i></a>
        </div>
        <div class="social telegram">
            <a href=""><i class="fa-brands fa-telegram" style="color:#3AAFE1;"></i></a>
        </div>
    </div>
    @yield('content-clients')
    <!-- Footer -->
    @include('Clients.blocks.footer')
    @yield('js')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
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

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('toast'))
                var toastEl = document.getElementById('loginToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            @endif
        });
        
    </script>
</body>

</html>
