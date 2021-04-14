@extends('layout.newapp6')
@section('content')
<div class="container">
   
   <div class="col-md-10" style="margin-left: 100px">
    
      
      <h1>Payment</h1>
      <form method="post" action="{{ route('mca_admission_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 input-group">
               <label class="input-group-btn" style="width: 130px;  ">
                 <span class="btn btn-view btn-primary" >
                    Fees<input type="text" id="paymentAmount" name="paymentAmount"  style="display: none; " disabled="" >
                 </span>
              </label>
              @if($users[0]->balance_amt)
              <input type="text"  class="form-control " id="amount" name="amount" value="{{$users[0]->balance_amt}}"  style="color: black; z-index:0 !important; width: 500px!important;" readonly>
              @elseif($fees[0]->amt)
              <input type="text" class="form-control" id="amount" name="amount" value="{{$fees[0]->amt}}"  style="color: black ;z-index:0 !important; width: 500px !important;" readonly>
              @elseif($part['amt'])
              <input type="text" class="form-control" id="amount" name="amount" value="{{$part['amt']}}"  style="color: black ;z-index:0 !important; width: 500px !important;" readonly>
              @endif
               
            </div>
        </div>
        
        <div class="form-group col-md-12">
                   <div class="form-group col-md-6">
                        <a href="{{ route('mca_showDD') }}"><button type="button" id="by_dd" class="button btn-view" name="by_dd">Demand Draft (DD)</button></a>     
                   </div>
                   <div class="form-group col-md-6">
                       <button type="submit" id="other_means" class="button btn-view" name="other_means">Other Means</button>
                   </div>
        </div>
        </div>
      </form>
   </div>
</div>
<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>

<br><br><br>
@endsection