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
    <p>{{ $body }}.</p>
    <table class="table">
  <thead>
    <tr>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">MisterPharmacist Prescription label Number R#</th>
      <th style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;" scope="col">Medicine Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($existing as $exist)
        <tr>
        <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$exist['rx']}}</td>
        <td style="box-sizing: border-box;padding: .30rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #fff!important;border: 1px solid #dee2e6!important;">{{$exist['medicine']}}</td>
        </tr>
    @endforeach
  </tbody>
</table>
    <p></p>
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