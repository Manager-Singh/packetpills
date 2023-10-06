@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
small.seond-heading {
    font-size: 12px;
    padding-left: 20px;
}
</style>
@endpush
@section('content')
<ul class="nav nav-tabs mb-3 justify-content-end" id="ex1" role="tablist">
          <li class="nav-item" role="presentation">
            <p>Showing: </p>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1" data-mdb-toggle="tab" href="#all" role="tab" aria-controls="tabs-1" aria-selected="true">All</a>
          </li>

        </ul>

        <div class="row mt-5">
          <div class="col-md-1">
            </div>
         <div class="col-md-10">
         
          <div class="accordion" id="accordionExample">
            <div class="card">
              <h2 class="card-header" id="headingOne">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Proctodan-hc Oint 
                </button>
                <small class="seond-heading">"Apply topically to anal area twice daily"</small>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <table>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    </table>
                </div>
              </div>
            </div>
            <div class="card">
              <h2 class="card-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <span>Proctodan-hc Oint </span>
                  
                </button>
                
                <small class="seond-heading">"Apply topically to anal area twice daily"</small>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <table>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Automatically refill this medication?</td><td class="text-right">30 unit(s)</td></tr>
                    </table>
                  </div>
              </div>
            </div>
           
          </div>
      </div>
        <div class="col-md-1">
        </div>
        </div>

@endsection

@push('after-scripts')
@if(config('access.captcha.login'))
@captchaScripts
@endif
@endpush