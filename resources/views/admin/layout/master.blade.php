<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    @yield('title')

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="">
                            <a href="{{ route('admin#categoryList') }}">
                                <i class="fa fa-th-list"></i>Category</a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin#productList') }}">
                                <i class="zmdi zmdi-pizza"></i>Product</a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin#orderList') }}">
                                <i class="fa fa-list"></i>Orders</a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin#userList') }}">
                                <i class="fa fa-users"></i>Users</a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin#messageList') }}">
                                <i class="zmdi zmdi-comment-text"></i>Messages</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">

                            @yield('navTitle')

                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->profile_photo_path == null)
                                                <img src='https://ui-avatars.com/api/?name={{Auth::user()->name}}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg' alt='John Doe' />
                                            @else
                                                <img class="" src="{{asset("storage/".Auth::user()->profile_photo_path)}}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->profile_photo_path == null)
                                                        <img src='https://ui-avatars.com/api/?name={{Auth::user()->name}}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg' alt='John Doe' />
                                                    @else
                                                        <img class="" src="{{asset("storage/".Auth::user()->profile_photo_path)}}" alt=""/>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-body">
                                                <div class="py-3 px-4">
                                                    <a href="{{route('admin#account')}}" class="text-dark">
                                                        <i class="zmdi zmdi-account mr-4"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-body">
                                                <div class="py-3 px-4">
                                                    <a href="{{route('admin#list')}}" class="text-dark">
                                                        <i class="zmdi zmdi-account mr-4"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-body">
                                                <div class="py-3 px-4">
                                                    <a href="{{route('admin#password')}}" class="text-dark">
                                                        <i class="zmdi zmdi-key mr-3"></i> Change Password
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form class="py-3 px-4" action="{{ route('logout') }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="text-dark">
                                                        <i class="zmdi zmdi-power mr-4"></i>Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('mainContent')

        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    @stack('modals')

    @livewireScripts

    @yield('scriptSrc')
</body>

</html>
<!-- end document-->
