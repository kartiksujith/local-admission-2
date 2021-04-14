@extends('layout.newapp6')
@section('content')
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
    <p>You don't have javascript enabled.  Good luck with that.</p>
    </div>
</noscript>
<div class="container">
   <div class="col-md-12" >  
   

      <h1>Final Submission</h1>
      <form method="post" action="{{ route('mca_final_submit') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
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
         <div class="form-group col-md-12">
            <a href="{{ route('mca_final_submit') }} ">
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
            <a href="{{ route('mca_final_submit') }} ">
              @if($check[0]->is_dte_details_completed == 1 && $check[0]->is_academic_completed == 1 && $check[0]->is_personal_completed == 1 && $check[0]->is_guardian_completed == 1 && $check[0]->is_contact_completed == 1 && $check[0]->is_document_completed == 1 )
               <button type="submit" class="btn btn-primary btn-view pull-left" id="submit" namca="submit" style="width: 100%" >Submit</button>
               @else
               <button type="button" class="btn btn-primary btn-view pull-left" id="submit" namca="submit"  style="width: 100% " disabled>Submit</button>
               @endif
            </a>
         </div>
          @endif
      </form>
   </div>
</div>
<br><br><br><br>
@endsection