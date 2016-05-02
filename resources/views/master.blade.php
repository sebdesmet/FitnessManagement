<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <link href="http://localhost/css/lightbox.css" rel="stylesheet">
    <title>FitnessManagement</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">


    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home')}}">FitnessManagement</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">


                <ul class="nav navbar-nav navbar-right">
                    @if(auth()->guest())
                        @if(!Request::is('/auth/login'))
                            <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        @endif
                        @if(!Request::is('/auth/register'))
                            <li><a href="{{ url('/auth/register') }}">Register</a></li>
                        @endif
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</head>

<body style="background-color:darkgray;">
<div style="position:absolute;width: 20%;border: solid darkgray 2px;margin-left:30px;background-color: white;">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('myuser') }}">Vos utilisateurs</a></li>
        <li><a href="{{ url('liste') }}">Liste des utilisateurs</a></li>
        <li><a href="{{ url('waiting') }}">En attente</a></li>


        </li>
    </ul>
</div>

@yield('content')

        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
<script src="http://localhost/js/jquery.toastmessage.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/css/jquery.toastmessage.css">
<script src="http://localhost/js/contact.js"></script>
<script src="http://localhost/js/lightbox.js"></script>
</body>
</html>