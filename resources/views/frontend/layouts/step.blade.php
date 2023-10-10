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
      <title>@yield('title')</title>
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
          </style>     
    <link rel="shortcut icon" href="{{asset('step/assets/images/logo.png')}}" type="images/png" id="favicon">
	
    <link rel="stylesheet" href="{{asset('step/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('step/assets/font/font.css')}}">
    <link rel="stylesheet" href="{{asset('step/assets/css/common-style.css')}}">
    <link rel="stylesheet" href="{{asset('website/assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('plugins/parsley/parsley.css')}}">
    <link rel='stylesheet' href='//common.olemiss.edu/_js/sweet-alert/sweet-alert.css'></link> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" /> 
  </head>
  <body>
      
           
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
        
        <main>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                @include('includes.partials.messages')
              </div>
            </div>
          </div>
        
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
