@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="registration-home" style="background: #54c7da;">

    @include('frontend.home.register')
    {{generateOTP()}}
</div>
  
@endsection
