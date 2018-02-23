<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Remainder App</title>
        <!-- Vendor styles -->
        <link rel="stylesheet" href="bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="bower_components/jquery.scrollbar/jquery.scrollbar.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
    </head>

    <body data-ma-theme="green">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="{{ url('/') }}">Remainder</a></h1>
                </div>

                
                <a class="dropdown-item" style="float: right; width: 70px; " href="{{ url('/') }}/logout">Logout</a>

                
            </header>
            <?php $user = Illuminate\Support\Facades\Auth::user();  ?>
            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="img/profile-pics/8.jpg" alt="">
                            <div>
                                <div class="user__name">{{ $user->first_name . ' ' . $user->last_name }}</div>
                                <div class="user__email">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">View Profile</a>
                            <a class="dropdown-item" href="{{ url('/') }}/logout">Logout</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li><a href="{{ url('/') }}"><i class="zmdi zmdi-home"></i> Home</a></li>


                        <li><a href="{{ url('/') }}/users"><i class="zmdi zmdi-accounts"></i> Manage Users</a></li>

                        <li><a href="{{ url('/') }}/reports"><i class="zmdi zmdi-file-text"></i> Reports</a></li>

                        <li><a href="{{ url('/') }}/my-report"><i class="zmdi zmdi-file"></i> My Report</a></li>

                        <li><a href="{{ url('/') }}/account"><i class="zmdi zmdi-account"></i> Account</a></li>

                    </ul>
                </div>
            </aside>

            

            <section class="content">

                @yield('content')


                <footer class="footer hidden-xs-down">
                    <p>© All rights reserved.</p>

                </footer>
            </section>
        </main>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
    </body>
</html>