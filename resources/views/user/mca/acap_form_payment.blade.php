@extends('layout.acap')
@section('content')
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<div class="container">
   <br><br><br>
   <div class="col-md-12">
      <h1>Payment</h1>
      <form method="post" action="{{ route('mca_acap_form_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 col-sm-12 input-group">
               <label class="input-group-btn" style="width:120px; ">
                 <span class="btn  btn-view btn-primary" style=" padding-left: 10px;padding-top: 10px;  height:60px; ">
                    Form Fees<input type="text" id="paymentAmount" name="paymentAmount"  style="display: none;" disabled="">
                 </span>
              </label>
              <input type="text" class="form-control " value="2360" disabled style=" z-index: 0; color: black; min-width: 100px; height:60px;  ">
              <span class="input-group-addon  btn-view " style=" width:100%; height: 60px; margin-right: 5%; margin-left: 5%;"><button class ="btn-view"type="submit">Pay Now</button>
                </span>
           </div>
         </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>

<br><br><br>
@endsection