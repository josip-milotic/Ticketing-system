<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ticketing System</title>
    <link rel="shortcut icon" href="{{ asset('img/a.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <!-- https://drive.google.com/file/d/1pAYFge4T3gbIcFaovKSjRw_yGYh6W7sm/view?usp=sharing-->
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet"
          href="https://raw.githubusercontent.com/ysoftaoglu/GradientButtons/master/gradient-buttons/gradient-buttons.min.css"/>

    <style>

        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }

        html, body {
            background-color: #fafafa;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .t {
            min-height: 80%;
        }
    </style>
</head>

<body class="grey lighten-3">

<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light winter-neva-gradient scrolling-navbar">
        <div class="container-fluid">
        @guest
            <!-- Brand -->
                <a class="navbar-brand waves-effect" href="{{route('home')}}">
                    <strong class="text-white">Ticketing System</strong>
                </a>

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{Request::path() === '/home' ? 'active' : ''}}">
                            <a class="nav-link waves-effect" href="{{route('home')}}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                @else
                    <!-- Brand -->
                        <a class="navbar-brand waves-effect" href="{{route('home')}}">
                            <strong class="text-white">Ticketing System</strong>
                            @yield('nav')
                        </a>
                @endguest

                <!-- Right -->
                    <ul class="navbar-nav ml-auto right">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.show',auth()->user()) }}">
                                    My profile
                                </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications.show') }}">
                                Notifications
                            </a>
                         </li>
                         <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                             </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endguest
                    </ul>
                </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

        @guest
            <a class="logo-wrapper waves-effect" href="{{route('home')}}">
                <img src="{{asset('img/unnamed.png')}}" class="img-fluid" alt="">
            </a>

        @else

            <a class="logo-wrapper waves-effect" href="{{route('home')}}">
                <img src="{{asset('img/unnamed.png')}}" class="img-fluid" alt="">
            </a>

            <div class="list-group list-group-flush">
                <a href="{{route('home')}}"
                   class="list-group-item list-group-item-action waves-effect {{Route::is('home') ? 'active' : ''}}">
                    <i class="fas fa-chart-pie mr-3"></i>Home
                </a>
                @if(auth()->user()->role_id =='2')
                    <a href="{{route('clients.index')}}"
                       class="list-group-item list-group-item-action waves-effect {{Route::is('clients.index') ? 'active' : ''}}">
                        <i class="fas fa-ticket-alt mr-3 "></i>Clients</a>

                    <a href="{{route('tickets.index')}}"
                       class="list-group-item list-group-item-action waves-effect {{Route::is('tickets.index') ? 'active' : ''}}">
                        <i class="fas fa-clipboard-list mr-3 "></i>Tickets</a>

                    <a href="{{route('comments.index')}}"
                       class="list-group-item list-group-item-action waves-effect {{Route::is('comments.index') ? 'active' : ''}}">
                        <i class="fas fa-comment-dots mr-3 "></i>Comments</a>

                    <a href="{{route('states.index')}}"
                       class="list-group-item list-group-item-action waves-effect {{Route::is('states.index') ? 'active' : ''}}">
                        <i class="fas fa-satellite mr-3 "></i>States</a>
                @endif
                @if(auth()->user()->role_id =='1')

                    <a href="#client"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('clients.index','clients.create','clients.show','clients.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-ticket-alt mr-3"></i>Clients</a>

                    <ul class="collapse list-unstyled" id="client">
                        <li><a href="{{route('clients.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('clients.index') ? 'active' : ''}}">View
                                Clients</a></li>
                        <li><a href="{{route('clients.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('clients.create') ? 'active' : ''}}">Create
                                Client</a></li>
                    </ul>


                    <a href="#ticket"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('tickets.index','tickets.create','tickets.show','tickets.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-clipboard-list mr-3"></i>Tickets</a>


                    <ul class="collapse list-unstyled" id="ticket">
                        <li><a href="{{route('tickets.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('tickets.index') ? 'active' : ''}}">View
                                Tickets</a></li>
                        <li><a href="{{route('tickets.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('tickets.create') ? 'active' : ''}}">Create
                                Ticket</a></li>
                    </ul>


                    <a href="#comment"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('comments.index','comments.create','comments.show','comments.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-comment-dots mr-3"></i>Comments</a>


                    <ul class="collapse list-unstyled" id="comment">
                        <li><a href="{{route('comments.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('comments.index') ? 'active' : ''}}">View
                                Comments</a></li>
                        <li><a href="{{route('comments.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('comments.create') ? 'active' : ''}}">Create
                                Comment</a></li>
                    </ul>

                    <a href="#state"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('states.index','states.create','states.show','states.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-satellite mr-3"></i>States</a>


                    <ul class="collapse list-unstyled" id="state">
                        <li><a href="{{route('states.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('states.index') ? 'active' : ''}}">View
                                States</a></li>
                        <li><a href="{{route('states.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('states.create') ? 'active' : ''}}">Create
                                State</a></li>
                    </ul>

                    <a href="#role"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('roles.index','roles.create','roles.show','roles.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-satellite mr-3"></i>Roles</a>


                    <ul class="collapse list-unstyled" id="role">
                        <li><a href="{{route('roles.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('roles.index') ? 'active' : ''}}">View
                                Roles</a></li>
                        <li><a href="{{route('roles.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('roles.create') ? 'active' : ''}}">Create
                                Roles</a></li>
                    </ul>

                    <a href="#user"
                       class="list-group-item list-group-item-action waves-effect dropdown-toggle {{Route::is('users.index','users.create','users.show','users.edit') ? 'active' : ''}}"
                       data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-user mr-3"></i>Users</a>


                    <ul class="collapse list-unstyled" id="user">
                        <li><a href="{{route('users.index')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('users.index') ? 'active' : ''}}">
                                View Users</a></li>
                        <li><a href="{{route('users.create')}}"
                               class="list-group-item list-group-item-action waves-effect border-0 {{Route::is('users.create') ? 'active' : ''}}">Create
                                User</a></li>
                    </ul>


                @endif
            </div>

        @endguest
    </div>
    <!-- Sidebar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="pt-5 mx-lg-5 t">

    <div class="container-fluid mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="{{route('home')}}">Home page</a>
                    <span> / </span>
                    @yield('linked')
                </h4>
                <div class="row">

                    @yield('button')
                </div>

            </div>

        </div>
        <!-- Heading -->

    @yield('auth')

    <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-12 mb-12">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">

                        @yield('content')

                    </div>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->
        </div>
    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small blue-gradient darken-2 mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
        <a class="btn btn-outline-white text-white" href="{{route('tickets.create')}}"
           role="button">Create Ticket
            <i class="fas fa-download ml-2"></i>
        </a>
        <a class="btn btn-outline-white text-white" href="{{route('home')}}"
           role="button">Home
            <i class=""></i>
        </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
        <a href="https://www.facebook.com/assecoseehrvatska/" target="_blank">
            <i class="fab fa-facebook-f mr-3"></i>
        </a>

        <a href="https://github.com/Norgul/studenti2020x2" target="_blank">
            <i class="fab fa-github mr-3"></i>
        </a>

    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
        © 2019 Copyright: Josip & Toni
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/js.js')}}"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();

    $(document).ready(function () {

        fetch_customer_data();

        function fetch_customer_data(query = '') {
            $.ajax({
                url: "{{ route('ajax.search') }}",
                method: 'GET',
                data: {query: query},
                dataType: 'json',
                success: function (data) {
                    $('tbody').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            })
        }

        $(document).on('keyup', '#search', function () {
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });

</script>

</body>

</html>
