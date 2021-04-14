@extends('layout.newapp6')
@section('content')
<body>
<!--nav start-->
<!--   <header style="position: fixed;right: 1px; top: 80px; width: 100% !important;z-index: 1;">

            <nav id="menu" style="background-color: #204a84;">
    
                         <input type="checkbox" id="tm">
                         <ul class="main-menu clearfix">
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="https://ves.ac.in " ><i class="fa fa-fw fa-home";></i>Home&nbsp</a></li>
                </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_dte_details') }} " ><i class="fa fa-fw fa-home";></i>DTE Details</a></li>
                </div>
              </div>
              
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_academic_details') }}" ><i class="fa fa-fw fa-home";></i>Academic Details</a></li>
               </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_personal_details') }}" ><i class="fa fa-fw fa-home";></i>Personal Details</a></li>
               </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_guardian_details') }}" ><i class="fa fa-fw fa-home"></i>Guardian Details</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_contact_details') }}" ><i class="fa fa-fw fa-home"></i>Contact Details</a></li>
              </div>
              </div>
              
              
              
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_document_upload') }}"><i class="fa fa-fw fa-database"></i>Document Upload&nbsp</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_admission_payment') }}"><i class="fa fa-fw fa-database"></i>Payment</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_final_submit') }}"><i class="fa fa-fw fa-database"></i>Final Submission</a></li>
              </div>
              </div> 
                <div class="col-md" >
                  <div class="abc">
                           <li><a href="{{ route('me_profile') }} " ><i class="fa fa-fw fa-user"></i>Profile</a></li>
          
                </div>
                </div>
               
                <div class="col-md" >
                    <div class="abc">
                        <li><a href="{{ route('logout') }} " ><i class="fa fa-fw fa-power-off"></i>Logout</a></li>
                  </div>
                  </div>
              </nav>
            </header> -->
            
            <!--nav end--> 
<div class="container">
   <div class="col-md-2">
     
   </div>
   <div class="col-md-12">
      <h1>Payment</h1>
      <form method="post" action="{{ route('me_admission_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 input-group">
               <label class="input-group-btn" style="width: 100px;">
                 <span class="btn btn-primary btn-view">
                    Fees<input type="text" id="paymentAmount" name="paymentAmount"  style="display: none;" disabled="" >
                 </span>
              </label>
              @if($users[0]->balance_amt)
              <input type="text" class="form-control" id="amount"  style="z-index: 0;" name="amount" value="{{$users[0]->balance_amt}}"  style="color: black" readonly>
              @elseif($fees[0]->amt)
              <input type="text" class="form-control" id="amount" style="z-index: 0;" name="amount" value="{{$fees[0]->amt}}"  style="color: black" readonly>
              @elseif($part['amt'])
              <input type="text" class="form-control" id="amount" style="z-index: 0;" name="amount" value="{{$part['amt']}}"  style="color: black" readonly>
              @endif
               
            </div>
        </div>
        
        <div class="form-group col-md-12">
                   <div class="form-group col-md-6 col-sm-12">
                        <a href="{{ route('me_showDD') }}"><button type="button" id="by_dd" class="button btn-view" name="by_dd">Demand Draft (DD)</button></a>     
                   </div>
                   <div class="form-group col-md-6 col-sm-12 ">
                       <button type="submit" id="other_means" class="button btn-view" name="other_means">Other Means</button>
                   </div> 
        </div>  
        </div>  
      </form> 
   </div>

<b><font color="red">NOTE :DO NOT REVERT BACK FROM THE PAYMENT GATEWAY. RELOADING PAYMENT GATEWAY MULTIPLE TIMES CAN BLOCK THE USER. IN CASE OF SLOW INTERNET CONNECTION DO NOT REFRESH THE PAGE. BE PATIENT. </font> </b>
</div>
<br><br><br>
</body>
@endsection