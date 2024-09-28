
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

    <!-- Custom CSS -->
    <style>
        *{
          padding: 0;
          margin: 0;
          box-shadow: border-box;
        }
        a{
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

        .hero-section {
            color: white;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
        }
        .mascot-section{
          position: absolute;
          top: 170px;
        }
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; 
        }

        .custom-video {
            width: 100%; 
            height: auto;
            /* object-fit: cover;  */
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 150px; 
            border-bottom-right-radius: 150px;
        }

        </style>
    @yield('css')
</head>

<body>
  @include('clients.blocks.header')

    @yield('content-clients')
    <!-- Footer -->
    @include('Clients.blocks.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- @yield('js') --}}

</body>

</html>
