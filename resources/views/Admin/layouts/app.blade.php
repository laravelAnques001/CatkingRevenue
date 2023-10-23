<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('Admin.Partials.head')
    @stack('head_script')
</head>

<body>
    <!-- Page content -->
    <div class="page-content">
        @include('Admin.Partials.sidebar')

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Main navbar -->
            @include('Admin.Partials.navbar')
            <!-- /main navbar -->

            <div class="content-inner">
                <!-- Content area -->
                @yield('content')
                <!-- /content area -->

                @include('Admin.Partials.footer')
            </div>
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>

</html>
