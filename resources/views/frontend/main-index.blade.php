@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="registration-home">
    @include('frontend.home.main')
    {{generateOTP()}}
</div>
  
@endsection
