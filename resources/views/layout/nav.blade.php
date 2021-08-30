<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharma</title>
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="bg-gradient-success">
    @auth
    <div class="d-flex" id="wrapper">
        <div class="bg-white text-center" id="sidebar-wrapper">
            <div class="sidebar-heading"><img src="{{asset('assets/img/logo.svg')}}" width="50" alt=""><span
                    class="ml-3">Pharma</span></div>
            <div class="list-group list-group-flush">
                @foreach ($sidebar as $item)
            <a href="{{Str::lower(str_replace(' ' , '' ,$item->name))}}" class=" btn btn-success btn-lg m-3 radius-20">
                    <i style="position: absolute;left:0" class="{{$item->icon}} ml-3"></i>
                    {{$item->name}}</a>
                @endforeach
                <form action="logout" method="POST">
                    @csrf
                    <button class=" btn btn-danger btn-lg rounded-0 mt-4 mb-3 mr-0 w-100 shadow-none">
                    <i class="ion-log-out ml-3" style="position: absolute;left:0"></i>    
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white p-2">
                <button class="btn btn-success radius-20" id="menu-toggle">Toggle Menu</button>
            </nav>
            <div class="container-fluid">
                @endauth

                @yield('content')

                @auth
            </div>
        </div>
    </div>
    @endauth
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>
