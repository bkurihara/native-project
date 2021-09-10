<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="{{base_url("public/css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{base_url("public/css/fontawesome/css/all.min.css")}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="{{base_url("public/js/bootstrap/bootstrap.min.js")}}"></script>
    <script src="{{base_url("public/js/jquery-3.6.0.min.js")}}"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
</head>

<body class="bg-light">
@include('components.navbar')
@yield('content')
@yield('js')
</body>
</html>