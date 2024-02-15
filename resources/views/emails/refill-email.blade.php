<!-- Hello <strong>{{ $name }}</strong>,
<p>{{$body}}
</p> -->
<!DOCTYPE html>
<html>
<head>
    <title>Toronto's Online Pharmacy</title>
</head>
<body>

    <p>Hello, {{ $name }}</p>
    <p>{{ $body }} </p>
    <p> {{$existing['patient']['name']}} Is requesting a refill for the above indicated medication Please review the patient pharmacy record and determine if the medication can be refilled or the patient healthcare provider needs to be contacted to reissue the refill- Please use your professional judgement and contact the patient to inform of the appropriate next steps</p>

    <p><strong>Patient's Detail:</strong></p>
    <table class="table">
  <thead>
  </thead>
  <tbody>
    <tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Name</th>
      <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$existing['patient']['name']}}</td>
    </tr>
    <tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Email</th>
      <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$existing['patient']['email']}}</td>
    </tr>
    <tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">DOB</th>
      <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$existing['patient']['dob']}}</td>
   </tr>
    </tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Mobile</th>
      <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$existing['patient']['mobile']}}</td>
    </tr>
   
  </tbody>
</table>

    <p></p>
    <p><strong>Medication Details:</strong></p>
    <p>Prescription ID :  {{$existing['patient']['prescription_id']}}</p>
    <table class="table">
  <thead>
    <tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Drug Name</th>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Prescribing Doctor</th>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    @foreach($existing['medications'] as $medication)
        <tr>
        <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$medication->drug_name}}</td>
        <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$medication->prescribing_doctor}}</td>
        <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$medication->price}}</td>
        </tr>
    @endforeach
  </tbody>
</table>
    <p></p>
    <p></p>
</br>
</br>
<footer style="margin-top:50px">
    @if(isset($setting->logo_path))
    <img width="200" src="https://account.misterpharmacist.com/public/website/assets/images/logo.gif" />
    
        <!-- <img width="200" src="{{$setting->logo_path}}" /> -->
    @else
        <img width="200" src="https://account.misterpharmacist.com/public/website/assets/images/logo.gif" />
    @endif
    

    <p >{{ (isset($setting->thanks_regards)) ? $setting->thanks_regards : 'Thanks & Regards!' }}</p>
    <p>{{ (isset($setting->desciption)) ? $setting->desciption : 'MisterPharmacist Online Pharmacy' }}</p>
    <p>Call: {{ (isset($setting->call)) ? $setting->call : '416-593-4000' }}</p> 
    <p>Fax: {{ (isset($setting->fax)) ? $setting->fax : '416-593-4166' }}</p> 
    <p>Email: {{ (isset($setting->email)) ? $setting->email : 'rx@misterpharmacist.com' }}</p>
    </footer>
</body>
</html>