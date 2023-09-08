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

        
    <link rel="shortcut icon" href="{{asset('step/assets/images/logo.png')}}" type="images/png" id="favicon">
	
	<link rel="stylesheet" href=".{{asset('step/assets/css/styles.css')}}">
	<link rel="stylesheet" href="{{asset('step/assets/font/font.css')}}">
	<link rel="stylesheet" href="{{asset('step/assets/css/common-style.css')}}">
	<link rel="stylesheet" href="{{asset('step/assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="{{asset('plugins/parsley/parsley.css')}}"> -->
    </head>
    <body>
      
           
        @include('includes.partials.read-only')
       @if(Route::currentRouteName() == 'frontend.user.dashboard')
       @include('frontend.navbar.step.header')
      @else
        <header>
		  <a href="{{url()->previous()}}"><img class="header-icon" src="{{asset('step/assets/images/arrow.png')}}" /></a>
		  <img class="header-logo" src="{{asset('step/assets/images/logo-main.png')}}" /> 
	  </header>
    @endif
        
        <main>
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
        <!-- <script src="{{asset('plugins/parsley/parsley.js')}}"></script> -->

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
