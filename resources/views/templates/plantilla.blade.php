<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <!-- para que vaya bootsrap -->
    <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css')}}">
    <script src="{{ asset("js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{ asset("js/popper.min.js")}}"></script>
    <script src="{{ asset("js/bootstrap.min.js")}}"></script>

    <!-- CSS MIAS -->
    <link rel="stylesheet" href="{{ asset ('css/miCss.css')}}">
</head>

<body>
 <nav class="navbar navbar-light navbar-expand-lg bg-dark navbar-fixed-top">
        <ul class="navbar-nav mr-auto">
            <!-- mr-auto margen Right automatico -->
            <li class="nav-item ">
            <a class="nav-link text-white" href="{{url('/frutas')}}"  role="button"> Frutas </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white" href="{{route('vistaFruita')}}" role="button"> Nueva </a>
            </li>
        </ul>
    </nav>

    @yield('principal')

</body>
</html>
