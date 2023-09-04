@extends('frontend.layouts.website')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
<style>
.hero__heading {
    font-size: 3.4rem;
    line-height: 1.2;
    margin-top: 3.2rem;
}
</style>
@endpush
@section('content')
<div class="registration-home" style="background: #54c7da;">

    @include('frontend.home.register')
    <!-- {{generateOTP()}} -->
</div>
  
@endsection
