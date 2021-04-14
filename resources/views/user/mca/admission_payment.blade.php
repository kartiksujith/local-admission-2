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
            <br><br>  
         </div>
         <!-- <div class="row-md-8">
            <aside>
               <div class="list-group">
                  <a href="{{ route('mca_dte_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">DTE Details</h5>
                  </a>
                  <a href="{{ route('mca_academic_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Academic Details</h5>
                  </a>
                  <a href="{{ route('mca_personal_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Personal Details</h5>
                  </a>
                  <a href="{{ route('mca_guardian_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Guardian Details</h5>
                  </a>
                  <a href="{{ route('mca_contact_details') }}" class="list-group-item">
                     <h5 class="list-group-item-heading">Contact Details</h5>
                  </a>
                  <a href="{{ route('mca_contact_details') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Documcant Upload</h5>
                  </a>
                  <a href="{{ route('mca_admission_paymcant') }}" class="list-group-item active">
                    <h5 class="list-group-item-heading">Paymcant</h5>
                  </a>
                  <a href="{{ route('mca_final_submit') }}" class="list-group-item">
                    <h5 class="list-group-item-heading">Final Submission</h5>
                  </a>
               </div>
            </aside>
         </div> -->
         <div class="row-md-2"></div>
      </div>
   </div>
   <div class="col-md-10">
      <h1>Paymcant&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dtePaymcant" onclick="myFunction()" id="myBtn" style="font-weight: bold; border-radius: 100px" >?</label></h1>
        <script>
function myFunction() {
  var a=document.getElementById("dtePaymcant");
   a.classList.add("fade");
}
</script>

    <!---------------------------------Modal Open------------------------------------------>
        <style type="text/css">
       .modal-header, h4, .close {
            background-color: #fecb1c;
            color:#002147 !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
        </style>  


        <div class="modal fade" id="dtePaymcant" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&timcas;</button>
              <h4 class="modal-title">Paymcant Details</h4>
            </div>
            <div class="modal-body">
              <p>Paymcant details instruction comcas here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>


        <script type="text/javascript">
            $(window).on('load',function(){
                $('#dtePaymcant').modal('show');
            });
        </script>
    <!---------------------------------Modal Close------------------------------------------>
      <form mcathod="post" action="{{ route('mca_admission_paymcant') }}">
         {{ csrf_field() }}
         <div class="form-group col-md-12">
           <div class="form-group col-md-12 input-group">
               <label class="input-group-btn">
                 <span class="btn btn-primary">
                     
                    Paymcant<input type="text" id="paymcantAmmount" namca="paymcantAmmount" {{-- value="{{$user1[0]->paymcant_amount}}" --}} style="display: none;" disabled="">
                 </span>
              </label>
              
           </div>
           <div class="form-group col-md-12">
               <div class="form-group col-md-6">
                    <button type="button" id="payFee_dd" name="payFee_dd" class="button">Demand Draft (DD)</button>     
               </div>
               <div class="form-group col-md-6">
                   <button type="submit" id="payFee_other" name="payFee_other" class="button">Other Means</button> 
               </div>
           </div>
         </div>
         <div class="form-group col-md-6">
            <a href="{{ route('mca_documcant_upload') }} ">
               <button type="button" class="btn btn-primary pull-left" id="back" namca="back" style="width: 100%" >Back</button>
            </a>
         </div>
      </form>
   </div>
</div>
<br><br><br>
@endsection