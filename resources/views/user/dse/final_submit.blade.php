@extends('layout.newapp6')
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

   <div class="col-md-2">
      <div class="col">
         <div class="row-md-2">

         </div>
         <!-- <div class="row-md-12">
            <aside>
               <div class="list-group">
              <a href="{{ route('dse_dte_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">DTE Details</h5>
              </a>
              <a href="{{ route('dse_academic_details') }}" class="list-group-item ">
                <h5 class="list-group-item-heading">Academic Details</h5>
              </a>
              <a href="{{ route('dse_personal_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Personal Details</h5>
              </a>
              <a href="{{ route('dse_guardian_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Guardian Details</h5>
              </a>
              <a href="{{ route('dse_contact_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Contact Details</h5>
              </a>
            @if(Session('log_acap')!="yes")
            <a href="{{ route('dse_document_upload') }}" class="list-group-item ">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            <a href="{{ route('dse_admission_payment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Payment</h5>
            </a>
            @else
            <a href="{{ route('dse_acap_document_upload') }}" class="list-group-item ">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            @endif
              <a href="{{ route('dse_final_submit') }}" class="list-group-item active" >
                <h5 class="list-group-item-heading">Final Submission</h5>
              </a>
            </div>
            </aside>
         </div> -->
         <div class="row-md-2"></div>
      </div>
   </div>
   <div class="col-md-12">
      <h1>Final Submission</h1>
      <form method="post" action="{{ route('dse_final_submit') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-10">
           <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sr No.</th>
                     <th>Page Name</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th>1</th>
                     <th>DTE Details</th>
                     <th>
                        @if($check[0]->is_dte_details_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th>2</th>
                     <th>Academic Details</th>
                     <th>
                        @if($check[0]->is_academic_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th>3</th>
                     <th>Personal Details</th>
                     <th>
                         @if($check[0]->is_personal_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th>4</th>
                     <th>Guardian Details</th>
                     <th>
                         @if($check[0]->is_guardian_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th>5</th>
                     <th>Contact Details</th>
                     <th>
                         @if($check[0]->is_contact_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th>6</th>
                     <th>Document Upload Details</th>
                     <th>
                        @if($check[0]->is_document_completed == 1)
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                        @else
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                        @endif
                     </th>
                  </tr>
                @if(Session('log_acap')!="yes")
                  <tr>
                     <th>7 </th>
                     <th>Payment Details</th>
                     <th>
                          @if($payment[0]->balance_amt === null) 
                            <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                            
                         @elseif($payment[0]->balance_amt != 0) 
                            <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                           
                           
                         @elseif($payment[0]->balance_amt === 0 )
                          <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}} 
                          
                         @endif 
                     </th>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
         @if(Session('log_acap')!="yes")
         <div class="form-group col-md-10">
            <a href="{{ route('dse_final_submit') }} ">
              @if($check[0]->is_dte_details_completed == 1 && $check[0]->is_academic_completed == 1 && $check[0]->is_personal_completed == 1 && $check[0]->is_guardian_completed == 1 && $check[0]->is_contact_completed == 1 && $check[0]->is_document_completed == 1 && $payment[0]->balance_amt == 0)
               <button type="submit" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" >Submit</button>
               @else
               <button type="button" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" disabled>Submit</button>
               @endif
            </a>
         </div>
          @endif
          @if(Session('log_acap')=="yes")
          <div class="form-group col-md-10">
            <a href="{{ route('dse_final_submit') }} ">
              @if($check[0]->is_dte_details_completed == 1 && $check[0]->is_academic_completed == 1 && $check[0]->is_personal_completed == 1 && $check[0]->is_guardian_completed == 1 && $check[0]->is_contact_completed == 1 && $check[0]->is_document_completed == 1 )
               <button type="submit" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" >Submit</button>
               @else
               <button type="button" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" disabled>Submit</button>
               @endif
            </a>
         </div>
          @endif
      </form>
   </div>
</div>
<br><br><br>
<style type="text/css">
  @media (min-width: 768px){}
.col-md-10 {
  max-width: 100%;
  }
}
</style>
@endsection