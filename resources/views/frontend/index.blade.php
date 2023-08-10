@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="registration-home">
    @include('frontend.auth.mobile-login')
    {{generateOTP()}}
</div>
  
@endsection
