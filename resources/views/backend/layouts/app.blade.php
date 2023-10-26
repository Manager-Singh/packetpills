<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
    <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
  

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
    
    @stack('after-styles')
    <style>
        .hidden {
            display: none !important;
        }
        #overlay{	
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100%;
            height:100%;
            display: none;
            background: rgba(0,0,0,0.6);
            }
            .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;  
            }
            .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
            }
            @keyframes sp-anime {
            100% { 
                transform: rotate(360deg); 
            }
            }
            .is-hide{
            display:none;
            }
            i.glyphicon.glyphicon-calendar {
                background: #e4e7ea;
                color: #00000070;
                font-size: 34px;
                border-radius: 0px 4px 0px 4px;
            }
            .header-fixed .app-header {
                padding: 0px 6px;
            }
            .navbar-badge {
                font-size: .6rem;
                font-weight: 300;
                padding: 2px 4px;
                position: absolute;
                right: 5px;
                top: -4px;
            }
            .blue-right-border{
                border-left: 1px solid #b4d4ef;
            }
    </style>
</head>

{{--
     * CoreUI BODY options, add following classes to body to change options
     * // Header options
     * 1. '.header-fixed'					- Fixed Header
     *
     * // Sidebar options
     * 1. '.sidebar-fixed'					- Fixed Sidebar
     * 2. '.sidebar-hidden'				- Hidden Sidebar
     * 3. '.sidebar-off-canvas'		    - Off Canvas Sidebar
     * 4. '.sidebar-minimized'			    - Minimized Sidebar (Only icons)
     * 5. '.sidebar-compact'			    - Compact Sidebar
     *
     * // Aside options
     * 1. '.aside-menu-fixed'			    - Fixed Aside Menu
     * 2. ''			    - Hidden Aside Menu
     * 3. '.aside-menu-off-canvas'	        - Off Canvas Aside Menu
     *
     * // Breadcrumb options
     * 1. '.breadcrumb-fixed'			    - Fixed Breadcrumb
     *
     * // Footer options
     * 1. '.footer-fixed'					- Fixed footer
--}}

<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">

    <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
    </div>
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div>
                    <!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div>
                <!--animated-->
            </div>
            <!--container-fluid-->
        </main>
        <!--main-->

        @include('backend.includes.aside')
    </div>
    <!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
   
 
    <script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    {!! script(asset('js/backend/common.js')) !!}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.0/Chart.bundle.js" integrity="sha512-piw5Tzhy4Xv8tQX9A7sysrIrNcsi5pWDSefF5P4bnWKlqfqwMFEdvTphOBcljyvsbyzVECi2Rsv46tztOTgs2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   


    @isset($js)
    @foreach($js as $j)
    {!! script(asset('js/backend/'. $j. '.js')) !!}
    @endforeach
    @endif

    @stack('after-scripts')

    @yield('pagescript')
</body>

</html>