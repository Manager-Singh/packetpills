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
@endpush
@section('content')
<div class="registration-home" style="background: #54c7da;">

    @include('frontend.home.register')
    <!-- {{generateOTP()}} -->
</div>
  
@endsection
