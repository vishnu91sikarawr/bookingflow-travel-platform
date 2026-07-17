<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'BookingFlow')</title>

    <meta name="description" content="BookingFlow - Online Bus Ticket Booking System">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            font-family:'Poppins',sans-serif;
            background:#f8f9fa;
            color:#212529;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        main{
            flex:1;
        }

        .navbar-brand{
            font-size:28px;
            font-weight:700;
        }

        footer{
            background:#212529;
            color:#fff;
            margin-top:80px;
            padding:25px 0;
        }

        .hero{
            background:linear-gradient(135deg,#0d6efd,#3b82f6);
            color:#fff;
            padding:90px 0;
        }

        .section-title{
            font-weight:700;
            margin-bottom:35px;
        }

        .card{
            border:none;
            border-radius:16px;
        }

        .btn{
            border-radius:10px;
        }

    </style>

    @stack('css')

</head>

<body>

@include('frontend.partials.navbar')

<main>

    @yield('content')

</main>

@include('frontend.partials.footer')

@stack('js')

</body>
</html>
