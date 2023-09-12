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
.hero__heading {
    font-size: 3.4rem;
    line-height: 1.2;
    margin-top: 3.2rem;
}
	

</style>
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
	</style>
    </head>
    <body>
      
           
        @include('includes.partials.read-only')
       
        @include('frontend.navbar.header')
        @if(Route::currentRouteName() == 'frontend.auth.new.login'  || Route::currentRouteName() == 'frontend.index'  )
        
        @else
            
        @endif
       
        <main>
            @yield('content')
            @if(Route::currentRouteName() == 'frontend.auth.new.login' || Route::currentRouteName() == 'frontend.index' )
            @else
                @include('frontend.navbar.footer')
            @endif 
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
