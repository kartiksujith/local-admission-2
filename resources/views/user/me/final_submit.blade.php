@extends('layout.newapp6')
@section('content')
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
                    <li ><a href="{{ route('me_admission_payment') }}"><i class="fa fa-fw fa-database"></i>Payment</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li class="active"><a href="{{ route('me_final_submit') }}"><i class="fa fa-fw fa-database"></i>Final Submission</a></li>
              </div>
              </div> -->
              
                <!-- <div class="col-md" >
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
            </header>  -->
            <!--nav end--> 
<div class="container">
   <div class="col-md-2">
      <div class="col">
        
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
                    <a href="{{ route('me_admission_payment') }}" class="list-group-item">
                      <h5 class="list-group-item-heading">Payment</h5>
                    </a>
                  @endif
                  <a href="{{ route('me_final_submit') }}" class="list-group-item active">
                    <h5 class="list-group-item-heading">Final Submission</h5>
                  </a>
               </div>
            </aside>
         </div> -->
         
      </div>
   </div>
   <div class="col-md-12" style="margin-left: 5%;margin-right: 5%;" >
     
      <h1>Final Submission</h1>
      <form method="post" action="{{ route('me_final_submit') }}">
         {{ csrf_field() }}
         <div class="form-group  col-md-10">
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
                        @if($check[0]->is_dte_completed == 1)
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
                     <th>7</th>
                     <th>Payment Details</th>
                     <th>
                          @if($payment[0]->balance_amt === 0) 
                           <font style="font-weight: bold; color: green;">Complete</font> {{-- show if complete --}}
                         @else 
                           <font style="font-weight: bold; color: red;">Incomplete</font> {{-- show if incomplete --}}
                         @endif 
                     </th>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
         @if(Session('log_acap')!="yes")
         <div class="form-group col-md-10">
            <a href="{{ route('me_final_submit') }} ">
              @if($check[0]->is_dte_completed == 1 && $check[0]->is_academic_completed == 1 && $check[0]->is_personal_completed == 1 && $check[0]->is_guardian_completed == 1 && $check[0]->is_contact_completed == 1 && $check[0]->is_document_completed == 1 && $payment[0]->balance_amt === 0)
               <button type="submit" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" >Submit</button>
               @else
               <button type="button" class="btn btn-view btn-primary pull-left" id="submit" namca="submit" style="width: 100%" disabled>Submit</button>
               @endif
            </a>
         </div>
          @endif
          @if(Session('log_acap')=="yes")
          <div class="form-group col-md-10">
            <a href="{{ route('me_final_submit') }} ">
              @if($check[0]->is_dte_completed == 1 && $check[0]->is_academic_completed == 1 && $check[0]->is_personal_completed == 1 && $check[0]->is_guardian_completed == 1 && $check[0]->is_contact_completed == 1 && $check[0]->is_document_completed == 1 )
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
@endsection