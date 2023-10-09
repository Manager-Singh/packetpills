@extends('frontend.layouts.step')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))
@push('after-styles')
<style>
small.seond-heading {
    font-size: 12px;
    padding-left: 20px;
}
.switch {
  float: right;
  position: relative;
  display: block;
  vertical-align: top;
  width: 100px;
  height: 30px;
  padding: 3px;
  margin: 0 10px 10px 0;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
  border-radius: 18px;
  box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
  cursor: pointer;
}
.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.switch-label {
  position: relative;
  display: block;
  height: inherit;
  font-size: 10px;
  text-transform: uppercase;
  background: #eceeef;
  border-radius: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  color: #aaaaaa;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: #FFFFFF;
  text-shadow: 0 1px rgba(0, 0, 0, 0.2);
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
  background: #0088cc;
  border-color: #0088cc;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}
.switch-handle {
  position: absolute;
  top: 4px;
  left: 4px;
  width: 28px;
  height: 28px;
  background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
  background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
  border-radius: 100%;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -6px 0 0 -6px;
  width: 12px;
  height: 12px;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
  left: 74px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}

/* Transition
========================== */
.switch-label, .switch-handle {
  transition: All 0.3s ease;
  -webkit-transition: All 0.3s ease;
  -moz-transition: All 0.3s ease;
  -o-transition: All 0.3s ease;
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
                    <!-- <tr>
                      <td>Automatically refill this medication?</td>
                      <td class="text-right">
                        <label class="switch">
                          <input class="switch-input" type="checkbox" />
                          <span class="switch-label" data-on="Yes" data-off="No"></span> 
                          <span class="switch-handle"></span> 
                        </label>
                      </td>
                    </tr> -->
                    <tr><td>Prescribing doctor</td><td class="text-right">Lorena Barrientos</td></tr>
                    <tr><td>Quantity left</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Quantity filled</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Pocketpacks</td><td class="text-right">No</td></tr>
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
                    <!-- <tr>
                      <td>Automatically refill this medication?</td>
                      <td class="text-right">
                        <label class="switch">
                          <input class="switch-input" type="checkbox" />
                          <span class="switch-label" data-on="Yes" data-off="No"></span> 
                          <span class="switch-handle"></span> 
                        </label>
                      </td>
                    </tr> -->
                    <tr><td>Prescribing doctor</td><td class="text-right">Lorena Barrientos</td></tr>
                    <tr><td>Quantity left</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Quantity filled</td><td class="text-right">30 unit(s)</td></tr>
                    <tr><td>Pocketpacks</td><td class="text-right">No</td></tr>
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