@extends('layout.newapp6')
@section('content')
<div class="container">
   <div class="col-md-2"> <br>
<br>
   </div>
   <div class="col-md-12">
    
      <h1>Payment</h1>
      <form method="post" action="{{ route('dse_admission_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 input-group">
               <label class="input-group-btn" style="width: 130px;">
                 <span class="btn btn-view btn-primary"  >
                    Form Fees<input type="text" id="paymentAmount" name="paymentAmount"  style="display: none; " readonly>
                 </span>
                </label>
              @if($users[0]->balance_amt)
              <input type="text" class="form-control" id="amount" name="amount" value="{{$users[0]->balance_amt}}" readonly style="color: black; z-index:0 !important; width: 500px!important;">
              @elseif($fees[0]->amt)
              <input type="text" class="form-control" id="amount" style="width: 600px!important; z-index: 0!important;" name="amount" value="{{$fees[0]->amt}}" readonly style="color: black; z-index:0 !important; width: 500px!important;">
              @elseif($part['amt'])
              <input type="text" class="form-control" id="amount" name="amount" style="width: 600px !important; z-index: 0!important;" value="{{$part['amt']}}" readonly style="color: black; z-index:0 !important; width: 500px!important;">
              @endif
             
           </div>
         </div>

        <div class="form-group col-md-12">
                   <div class="form-group col-md-6">
                        <a href="{{ route('dse_showDD') }}"><button type="button" id="by_dd" class="button btn-view" name="by_dd">Demand Draft (DD)</button></a>     
                   </div>
                   <div class="form-group col-md-6">
                       <button type="submit" id="other_means" class="button btn-view" name="other_means">Other Means</button>
                   </div> 
        </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>

<br><br><br>
@endsection