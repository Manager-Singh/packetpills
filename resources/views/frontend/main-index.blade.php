@extends('frontend.layouts.website')

@section('title','Create Account | ' . __('navs.general.home'))


@section('content')
<div class="registration-home" style="background: #54c7da; padding-top: 6.7rem;">

    @include('frontend.home.register')
    <!-- {{generateOTP()}} -->
</div>
  
@endsection
