<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('common.main.page_title') }}</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.framgia.com/jp">Framgia</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            {!! link_to('/home', 'Home') !!}
                        </li>
                        <li>
                            {!! link_to('users/list', 'Users') !!}
                        </li>
                        <li>
                            {!! link_to('words/', 'Words') !!}
                        </li>
                        @if ((!auth()->guest()) && ($user->isAdmin()))
                            <li>
                                {!! link_to('categories/', 'Categories') !!}
                            </li>
                        @else
                            <li>
                                {!! link_to('lessons/', 'Lessons') !!}
                            </li>
                            <li>
                            {!! link_to('activities', 'Activities') !!}
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (auth()->guest())
                            <li>
                                {!! link_to('auth/login/', 'Login') !!}
                            </li>
                            <li>
                                {!! link_to('auth/register/', 'Register') !!}
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        {!! link_to_route('users.edit', 'Update Profile') !!}
                                    </li>
                                    <li>
                                        {!! link_to('/auth/logout', 'Logout') !!}
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @include('shared.flash_message')
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>@yield('title')</h2>
                            @yield('title-meta')
                        </div>
                        <div class="panel-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p>Copyright &copy; 2016 | <a href="framgia.com/jp">Framgia</a></p>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('/js/jquery.min-2.1.3.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min-3.3.1.js') }}"></script>
    </body>
</html>
