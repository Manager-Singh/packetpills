@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

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
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Proctodan-hc Oint <br><span>"Apply topically to anal area twice daily"</span>
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
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
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Proctodan-hc Oint <br><span>"Apply topically to anal area twice daily"</span>
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
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