<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5">
      <meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- <title>@yield('title')</title> -->
      <title>MisterPharmacist Toronto | My Account</title>
      <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
      <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
    
      @yield('meta')
      @include('frontend.navbar.head')
      @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}
        
        @stack('after-styles')

          <style>
            header.re-header.show {
                padding: 2px 24px;
                border-radius: 0px !important;
                background-color: #fff;
                box-shadow: 0 2px 100px #0003;
                position: fixed;
                width: 100%;
                max-width: 100% !important;
                z-index: 8;
                padding-right: 0.8rem;
                transition: top .2s ease;
              } 
            .arrow-header{
                margin-top: 6rem;
                padding: 0;
              }
            .arrow-header a img {
                margin: 4px 28px;
              }
              header .row .column {
                  width: unset;
              }
              main.main-div {
                  margin-top: 3rem;
              }
              header.re-header.show.arrow-header{
                margin-top: 6rem;
                position: relative;
              }


              .loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
.loader {
    /* border: 4px solid #f3f3f3; */
    /* border-top: aliceblue; */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    box-shadow: -1px 3px 0px 0px #8ac03d;
}


@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

          </style>     
    <link rel="shortcut icon" href="{{asset('step/assets/images/logo.png')}}" type="images/png" id="favicon">
    <link rel="stylesheet" href="{{asset('css/responsive-style.css')}}">
    <link rel="stylesheet" href="{{asset('step/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('step/assets/font/font.css')}}">
    <link rel="stylesheet" href="{{asset('step/assets/css/common-style.css')}}">
    <link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('plugins/parsley/parsley.css')}}">
    <link rel='stylesheet' href='//common.olemiss.edu/_js/sweet-alert/sweet-alert.css'></link> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" /> 
    <link rel='stylesheet' href='//cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    @notifyCss
  </head>
  <body id="app">
      
           
        @include('includes.partials.read-only')
       @if(Route::currentRouteName() == 'frontend.user.dashboard' || (Auth::check() && Auth::user()->is_profile_status == "completed"))
       @include('frontend.navbar.step.header')
      @else
      @include('frontend.navbar.header')
      <header class="re-header show arrow-header">
        <a href="{{url()->previous()}}">
          <img class="header-icon" src="{{asset('step/assets/images/arrow.png')}}" />
        </a>
      </header>
    @endif
    <div class="loader-container">
  <div class="loader"></div>
</div>

        <main class="main-div">
          <div class="container mt-5">
            <div class="row">
              <div class="col-md-12">
                @include('includes.partials.messages')
              </div>
            </div>
          </div>
          <input type="hidden" name="latitude" id="latitude"/>
          <input type="hidden" name="longitude"  id="longitude"/>
            @yield('content')
           
        </main>
        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
       
        @stack('after-scripts')
        <script src="{{ asset('website/assets/js/runtime.js') }}" type="module"></script>
        <script src="{{ asset('website/assets/js/polyfills.js')}}" type="module"></script>
        <script src="{{ asset('website/assets/js/vendor.js')}}" type="module"></script>
        <script src="{{ asset('website/assets/js/main.js')}}" type="module"></script>
        <script src="{{asset('plugins/parsley/parsley.js')}}"></script>
        <script src="//common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        @notifyJs
        @include('notify::messages')
        <script>

 

 window.onload = function () {
      // Hide the loader after the page has loaded
      $(".loader-container").hide();
    };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                document.getElementById("latitude").value = latitude;
                document.getElementById("longitude").value = longitude;
            });
        } else {
            console.log('Geolocation is not supported in this browser.');
        }
    </script>
        <script>
    $(document).ready(function(){       
     
      $('button.user-ins').click(function(){
        $('.sidebar').toggle();
        
      });

      $('button.user-ins').click(function(){
        if ($('.dashboard .user-ins').hasClass("close")) {
          $('.dashboard .user-ins').removeClass("close");
      }
      else{
      $('.dashboard .user-ins').addClass("close");
    }
        
      });   

    

    });
    </script> 
    @include('includes.partials.ga')
   
      
    </body>
</html>
