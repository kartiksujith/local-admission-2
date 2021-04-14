@extends('layout.newapp6')
@section('content')
<div class="container">
   <div class="col-md-2"></div>
   <div class="col-md-8">
      <h1>Payment</h1>
      <form method="post" action="{{ route('dse_acap_form_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 col-sm-12 input-group">
               <label class="input-group-btn">
                 <span class="btn btn-primary">
                    Form Fees<input type="text" id="paymentAmount" name="paymentAmount" style="display: none;" disabled="">
                 </span>
              </label>
              <input type="text" class="form-control" value ="2360" disabled style="color: black; min-width: 100px; margin-left: 10%; margin-right: 10%;">
              <span class="input-group-addon" style="background-color:#002147">
                <input type="submit"  id="payment" name="payment" style="width: 100%; background-color: #002147;" class="btn btn-mine" value="Pay Now">
              </span>
           </div>
         </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>

<br><br><br>
@endsection