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
    </head>
    <body>
      
           
        @include('includes.partials.read-only')
       @if(Route::currentRouteName() == 'frontend.user.dashboard')
       <header class="header">
      <div class="row dashboard" >
        <div class="col-md-6">
          <p class="user-ins">AM</p>
          <p class="info">Viewing as</p>
          <p class="user-name">Alexandre</p>
        </div>
        <div class="col-md-6 text-end">
         <a href="#" class="profile-btn"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</a>
        </div>
      </div>  
      <div class="row menu">
        <ul>
          <li><a href="#" class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
          <li><a href="#"><i class="fa fa-medkit" aria-hidden="true"></i> Medication</a></li>
          <li><a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Prescription</a></li>
          <li><a href="#"><i class="fa fa-truck" aria-hidden="true"></i> Orders</a></li>
        </ul>

      </div>
		  
	  </header>
      @else
        <header>
		  <img class="header-icon" src="{{asset('step/assets/images/arrow.png')}}" />
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
        @include('includes.partials.ga')
    </body>
</html>
