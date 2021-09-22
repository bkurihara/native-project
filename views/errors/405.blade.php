<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="{{base_url("public/css/my-theme.css")}}" rel="stylesheet">
    <link href="{{base_url("public/css/fontawesome/css/all.min.css")}}" rel="stylesheet">
    <script src="{{base_url("public/js/bootstrap/bootstrap.bundle.min.js")}}"></script>
    <script src="{{base_url("public/js/jquery-3.6.0.min.js")}}"></script>
    @yield('css')
</head>
<body class="bg-light">
    <div class="d-flex justify-content-center min-vh-100 align-items-center">
        <div>
            <div class="card">
                <div class="bg-danger p-2"></div>
                <div class="shadow-lg card-body rounded p-3 text-center">
                    <img class="img-fluid" width="200px" src="{{base_url('public/images/dame.jpg')}}"/>
                    <h5 class="card-title mt-3 mb-2">WARNING</h5>
                    <p class="card-text px-3 border border-dark border-1 p-3 fst-italic">Some errors occured, this might be due to system internal errors<br> or user privilege access violations</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>