@extends('layout.newapp6')
@section('content')
<!--nav start-->
 <!--  <header style="position: fixed;right: 1px; top: 80px; width: 100% !important;z-index: 1;">

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
                    <li class="active"><a href="{{ route('me_admission_payment') }}"><i class="fa fa-fw fa-database"></i>Payment</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_final_submit') }}"><i class="fa fa-fw fa-database"></i>Final Submission</a></li>
              </div>
              </div> -->
              
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
            </header> 
            <!--nav end--> -->
<div class="container">
   <div class="col-md-2">
      <div class="col">
         <div class="row-md-2">
            <br><br><br><br><br>
         </div>
         <!-- <div class="row-md-8">
            <aside>
               <div class="list-group">
                  <a href="{{ route('me_dte_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">DTE Details</h5>
                  </a>
                  <a href="{{ route('me_academic_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Academic Details</h5>
                  </a>
                  <a href="{{ route('me_personal_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Personal Details</h5>
                  </a>
                  <a href="{{ route('me_guardian_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Guardian Details</h5>
                  </a>
                  <a href="{{ route('me_contact_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Contact Details</h5>
                  </a>
                  @if(Session('log_acap') == "yes")
                    <a href="{{ route('me_acap_document_upload') }}" class="list-group-item">
                      <h5 class="list-group-item-heading">Document Upload</h5>
                    </a>
                     @endif
                    @if(Session('log_acap')!="yes")
                    <a href="{{ route('me_document_upload') }}" class="list-group-item">
                      <h5 class="list-group-item-heading">Document Upload</h5>
                    </a>
                    <a href="{{ route('me_admission_payment') }}" class="list-group-item active">
                      <h5 class="list-group-item-heading">Payment</h5>
                    </a>
                  @endif
                  <a href="{{ route('me_final_submit') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Final Submission</h5>
                  </a>
               </div>
            </aside>
         </div> -->

      </div>
   </div>

   <div class="col-md-12">

      <h1>Payment</h1>
      <form method="post" action="{{ route('me_admission_payment') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 input-group">
               <label class="input-group-btn">
                 <span class="btn btn-primary">
                    Payment<input type="text" id="paymentAmmount" name="paymentAmmount" {{-- value="{{$user1[0]->payment_amount}}" --}} style="display: none;" disabled="">
                 </span>
              </label>
              <input type="text" class="form-control" disabled style="color: black">
              <span class="input-group-addon" style="background-color: #5cb85c;"><a href="" class="" id="payment" name="payment" style="width: 100%; color: #ffffff">Pay Now</a></span>
           </div>
         </div>
         <div class="form-group col-md-6">
            <a href="{{ route('me_document_upload') }} ">
               <button type="button" class="btn btn-view btn-primary pull-left" id="back" name="back" style="width: 100%" >Back</button>
            </a>
         </div>
      </form>
   </div>
</div>

<br><br><br>
@endsection