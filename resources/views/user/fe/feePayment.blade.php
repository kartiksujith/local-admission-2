@extends('layout.newapp6')
@section('content')
<div class="container">
   <div class="col-md-2">
     
   </div>
   <div class="col-md-12">
      <h1>Payment</h1>
      <form method="post" action="{{ route('fe_admission_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 col-sm-12 input-group">
               <label class="input-group-btn" style="width: 120px">
                 <span class="btn btn-view btn-primary" >
                    Form Fees<input type="text" id="paymentAmount" name="paymentAmount"  style="display: none;" disabled="">
                 </span>
              </label>
              @if($users[0]->balance_amt)
              <input type="text" class="form-control"  id="amount" name="amount" value="{{$users[0]->balance_amt}}" readonly style="color: black; z-index:0;">
              @elseif($fees[0]->amt)
              <input type="text" class="form-control"  id="amount" name="amount" value="{{$fees[0]->amt}}" readonly style="color: black;z-index:0;">
              @elseif($part['amt'])
              <input type="text" class="form-control"  id="amount" name="amount"  value="{{$part['amt']}}" readonly style="color: black;z-index:0;">
              @endif
             
           </div> 
         </div>
 
        <div class="form-group col-md-12">
                   <div class="form-group col-md-6 col-sm-12">
                        <a href="{{ route('fe_showDD') }}"><button type="button" id="by_dd" class="button btn-view" name="by_dd">Demand Draft (DD)</button></a>     
                   </div>
                   <div class="form-group col-md-6 col-sm-12">
                       <button type="submit" id="other_means" class="btn-view" name="other_means">Other Means</button>
                   </div> 
                   <!--  <div class="form-group col-md-4 col-sm-12">
                        <a href="{{ url('fe_cash') }}"><button type="button" id="Cash" class="button btn-view" name="Cash">Cash</button></a>     
                   </div> -->
                   
        </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>
<br><br><br>
@endsection