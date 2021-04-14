@extends('layout.acap')
@section('content')
<div class="container">
   <br>
   <br>
   <div class="col-md-12" style="padding-left:   50px;">
      <h1>Payment</h1>
      <form method="post" action="{{ route('me_acap_form_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12 " >
           <div class="form-group col-md-12 col-sm-12 input-group">
               <label class="input-group-btn"style="width: 120px">
                 <span class="btn btn-view btn-primary">
                    Form Fees<input type="text" id="paymentAmount" name="paymentAmount" style="display: none;" disabled="">
                 </span>
              </label>
              <input type="text" class="form-control" value ="2360" disabled style="color: black; z-index: 0; min-width: 100px;">
              <span class="input-group-addon btn-view" style="background-color:#204a84;margin-left: 10%; margin-right: 10%;">
                <input type="submit"  id="payment" name="payment" style="width: 100%;" class="btn btn-mine btn-view" value="Pay Now">
              </span>
           </div>
         </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>

<br><br><br>
@endsection