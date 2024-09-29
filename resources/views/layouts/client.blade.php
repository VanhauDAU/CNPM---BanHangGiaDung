
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
        }
        a{
          color: black;
          text-decoration: none;
        }
        body{
          position: relative;
        }
        .social-info {
            position: fixed;
            right: 30px;
            top: 60%;
        }

        .social-info .social {
            display: flex;
            justify-content: center;
            align-items: center; 
            border: 1px solid #ccc;
            border-radius: 50%;
            padding: 12px;
            height: 50px;width: 50px;
            margin: 10px 0px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease
        }
        .social-info .social:hover {
            transform: scale(1.2);
            cursor: pointer;
            background-color: aliceblue;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        @keyframes colorChange {
            0% { color: red; }
            25% { color: blue; }
            50% { color: green; }
            75% { color: yellow; }
            100% { color: red; }
        }
        .running-text {
            animation: colorChange 3s infinite; /* Thay đổi màu sắc trong 3 giây, lặp lại vô hạn */
            font-weight: bold; /* Đậm chữ */
            font-size: 25px;
        }
        /* thả xuống cho navbar */
        .nav-item.dropdown .collapse {
            padding-left: 15px;
        }

        .nav-item.dropdown .nav-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-item.dropdown .collapse .nav-link {
            padding-left: 30px;
        }

        .collapse {
            transition: height 0.2s ease-in-out;
        }

        </style>
    @yield('stylesheet')
</head>

<body>
  @include('clients.blocks.header')

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
      
    </script>
</body>

</html>
