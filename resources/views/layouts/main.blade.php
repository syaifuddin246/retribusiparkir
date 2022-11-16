<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicons -->
    <link href="{{ asset('Tempo/assets/img/icon.png') }}" rel="icon">
    <link href="{{ asset('Tempo/assets/img/icon.png') }}" rel="apple-touch-icon">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb_admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb_admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            @yield('content')

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb_admin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb_admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb_admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb_admin2/js/sb-admin-2.min.js') }}"></script>
  
</body>

</html>