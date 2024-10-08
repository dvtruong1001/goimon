@include('layouts.header')

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>


        @include('layouts.nav')
        @include('layouts.sidebar')

        @yield('content')

        @include('layouts.footer')
        @include('layouts.script')
        @yield('script')
        @include('layouts.end')
