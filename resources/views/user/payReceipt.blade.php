@extends('layout.app')
@section('content')
<noscript>
  <style type="text/css">
    .container {display:none;}
  </style>
  <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
  </div>
</noscript>
<body onload="moveProgress()">
  <form method="GET" action="{{route('payment')}}">
    {{csrf_field()}}
  <div class="container">
    <div class="col-md-12">
      <h1>Transaction Page</h1>
    </div>
<!----------------------------------------Progress Bar Star---------------------------------------->    
    <script type="text/javascript">
      function moveProgress()
      {
        var elem = document.getElementById("transactionProgress");   
        var width = 1;
        var id = setInterval(frame,100);
        function frame() {
          if (width >= 100) {
            clearInterval(id);
          } else {
            width++; 
            elem.style.width = width + '%';
            document.getElementById('showPercentage').innerHTML = width+0+'%';
           if(width == 100)
           {
               document.getElementById('showNext').style.display="block";
           }
          }
        }
      }
    </script>
    <div class="col-md-12">
        <div class="progress">
          <div id="transactionProgress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
            <label id="showPercentage"></label>
          </div>
        </div>
    </div>

<!----------------------------------------Progress Bar Close---------------------------------------->

<!----------------------------------------Success Message Open---------------------------------------->
  <style type="text/css">
    .btn-group-lg>.btn, .btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
    width: 100%;
    background: #002147;
    }
    #transaction
    {
      border:10px;
      width: 100%;
      border-radius: 60px;
      padding: 50px;
    }
    #transaction_data1
    {
      text-align: center;
      padding: 50px;
      color:green;
      font-size:35px;
    }
    #transaction_data2
    {
      text-align: center;
      padding: 50px;
      color:red;
      font-size:35px;
    }
    #transaction_row
    {
      border-radius: 50px;
    }
  </style>
  <div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
          <table id="transaction">
              @if($event == "322" || $event == "312" || $event == "422" || $event == "412" || $event == "122" || $event == "112" || $event == "222" || $event == "212" )
      <tr id="transaction_row">
        @if($referenceCode == "E000")
        <th id="transaction_data1" colspan="4">Your payment is successfully done. You can submit your admission form & report to institute for admission confirmation.</th>
        @elseif($referenceCode == "E00327")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation once the Cash Challan is realized in our account.</th>
        @elseif($referenceCode == "E00328")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation.</th>
        @elseif($referenceCode == "E00329")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation once the NEFT Transaction is realized in our account.</th>
        @else
        <th id="transaction_data2" colspan="4">Failure !</th>
        </tr>
        @endif
        @endif
        @if($event =="311" || $event =="411" || $event =="111" || $event =="211" )
        
        <tr id="transaction_row">
        @if($referenceCode == "E000")
        <th id="transaction_data1" colspan="4">Your payment is successfully done. You can now start filling your Against CAP form & report to institute after Submitting your form</th>
        @elseif($referenceCode == "E00327")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation once the Cash Challan is realized in our account.</th>
        @elseif($referenceCode == "E00328")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation.</th>
        @elseif($referenceCode == "E00329")
        <th id="transaction_data1" colspan="4">Your transaction is successfully done. You can submit your admission form & report to institute for admission confirmation once the NEFT Transaction is realized in our account.</th>
        @else
        <th id="transaction_data2" colspan="4">Failure !</th>
        </tr>
        @endif
        <tr>
          <td>
            Reason : {{$status}}
          </td>

      </tr>
      @endif
      
      <tr>
          <td>Transaction Reference No: {{$referenceNo}}</td>
      </tr>
      <tr>
          <td>Transaction ID: {{$transaction_ID}}</td>
      </tr>
      <tr>
          <td>Code : {{$referenceCode}}</td>
      </tr>
      <tr>
          <td>Redirecting ........</td>
      </tr>
    </table>
    </div>
    <div class="col-md-2"></div>
  </div>
  <div class="col-md-12">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <button type="submit" class="btn-lg">Next</button>
      </div>
      <div class="col-md-4" style="display:none;" id="showNext">
          <label style="font-size:25px; color:red;"><--- Click Here</label>
      </div>
  </div>

<!----------------------------------------Success Message Close---------------------------------------->
  
  </div>
  </form>
</body>
@endsection