<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="{{$themes->data_layout}}" data-topbar="{{$themes->data_topbar}}" data-sidebar="{{$themes->data_sidebar}}" data-sidebar-size="{{$themes->data_sidebar_size}}" data-sidebar-image="{{$themes->data_sidebar_image}}" data-preloader="{{$themes->data_preloader}}">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Grenviro Monitoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Grenviro Monitoring" name="description" />
    <meta content="Grenviro" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')
    @vite('resources/js/app.js')

    @livewireStyles

</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.customizer')

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>

</html>
