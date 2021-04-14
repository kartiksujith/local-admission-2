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
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>
<body onload="load('{{$user1[0]->g_relation}}','{{$parent_domicile}}','{{$user1[0]->g_office_tel_no}}','{{$user1[0]->g_office_address}}')">
<style>
.se-pre-con {
	position: fixed;
	left: 50%;
	top: 50%;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url({{ asset('images/loader.svg') }}) center no-repeat #fff;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
<script type="text/javascript">
  function load(r,p,gn,ga)
  {
    //showMother(r);
    if (p == "true") {
                document.getElementById('parentDomecileApplicationNo').value = '';
                document.getElementById('applicationDateOfParentDomecile').value = '';
            }
    if (p == "false") {
                document.getElementById('parentDomecileNo').value = '';
                document.getElementById('dateOfParentDomecile').value = '';
            }
    if (p == "na") {
                document.getElementById('parentDomecileApplicationNo').value = '';
                document.getElementById('applicationDateOfParentDomecile').value = '';
                document.getElementById('parentDomecileNo').value = '';
                document.getElementById('dateOfParentDomecile').value = '';
            }
            
     if(gn == '0')
      {
           document.getElementById('office_tel_no').value = '';
      }
      if(ga == 'NA')
      {
           document.getElementById('office_address').value = '';
      }
            
    yesnoCheck();
  }
</script>
<div class="container">
  <div class="col-md-2">
    <div class="col">
      
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
            <a href="{{ route('mca_guardian_details') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">Guardian Details</h5>
            </a>
            <a href="{{ route('mca_contact_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Contact Details</h5>
            </a>
            <a href="{{ route('mca_contact_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            @if(Session('log_acap')!="yes") 
            <a href="{{ route('mca_admission_payment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Payment</h5>
            </a>
            @endif 
            <a href="{{ route('mca_final_submit') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside>
      </div> -->
      <div class="row-md-2"></div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12">
      


    <h1>Guardian Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dteGuardian" id="myBtn"  onclick="myFunction()" style="font-weight: bold; border-radius: 100px">?</label></h1>
      <script>
function myFunction() {
  var a=document.getElementById("dteGuardian");
   a.classList.add("fade");
}
</script>

    <!---------------------------------Modal Open------------------------------------------>
    <style type="text/css">
      .modal-header, h4, .close {
       background-color: #204a84;
      color:#FFFF !important;
      text-align: center;
      font-size: 30px;
      }
      .modal-footer {
      background-color: #f9f9f9;
      }
    </style>
    <div class="modal " id="dteGuardian" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Guardian Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
            <p style="font-weight: bold;">Instructions</p>
            <table class="table table-striped table-bordered" id="academic_modal">
              <thead style="font-weight: bold; text-align: center;">
                <tr>
                  <td>Field / Section Name</td>
                  <td>Description</td>
                  <td>Example Input</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Husband / Father</td>
                  <td>Select Husband if you are a married woman. In this case you husband will be considered as your guardian and fill the following details accordingly.</td>
                  <td>Select the appropriate option.</td>
                </tr>
                <tr>
                  <td>Mother's Maiden Name</td>
                  <td>This field is only available if you select Father. <br> Enter First Name of your mother.</td>
                  <td>Ruchi</td>
                </tr>
                <tr>
                  <td>Mobile No.</td>
                  <td>Enter Your Guardians Contact No.</td>
                  <td>9876543210</td>
                </tr>
                <tr>
                  <td>Do You have Domicile?</td>
                  <td>This field is <font style="font-weight: bold;">COMPULSORY</font> for Candidates of <font style="font-weight: bold;">TYPE B</font></td>
                  <td>Select <font style="font-weight: bold;">YES</font> if you have domicile. <br> Select <font style="font-weight: bold;">NO</font> if you have domicile application.</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @if($user1[0]->is_guardian_completed==0)
    <script type="text/javascript">
      $(window).on('load',function(){
          $('#dteGuardian').modal('show');
      });
    </script>
    @endif
    <!---------------------------------Modal Close------------------------------------------>
    <form method="post" action="{{ route('mca_guardian_details') }}">
      {{ csrf_field() }}
      @if(session('error'))
          <center>
            <p style="color: red"> {{session('error')}}</p>
          </center>
          @endif 
      <div class="form-group col-md-12 col-sm-12">
            <center><h4 style="font-weight: bold; ">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
      <div class="form-group col-md-12 col-sm-12">
        <label for="dteId">DTE ID</label>
        <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}" placeholder="DTE ID" disabled>
      </div>
      <div class="form-group  col-md-12 col-sm-12">
        <label style="font-size: 18px;">Husband / Father</label> <p>     
        @foreach($relations as $key=>$relations)
        @if( $user1[0]->g_relation != $relations)
        <input type="radio" id="{{$key}}" name="relation" value="{{$relations}}" onchange="showMother('{{ $relations }}')">&nbsp;&nbsp;{{$key}}&nbsp;&nbsp; 
        @endif
        @if( $user1[0]->g_relation == $relations )
        <input type="radio"  id="{{$key}}" name="relation" value="{{$relations}}" onchange="showMother('{{ $relations }}')" checked>&nbsp;&nbsp;{{$key}}&nbsp;&nbsp;
        @endif
        @endforeach
        <!--<script type="text/javascript">-->
        <!--  function showMother(r) {-->
        <!--    if ( r == 'F') {-->
        <!--      document.getElementById('mothersName').style.display = "block";-->
        <!--      document.getElementById('motherMaidenName').required = true;-->
        <!--    }-->
        <!--    if ( r == 'H') {-->
        <!--      document.getElementById('mothersName').style.display = "none";-->
        <!--      document.getElementById('motherMaidenName').required = false;-->
        <!--    }-->
        <!--  }-->
        <!--</script>-->
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="firstName">First Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="{{$user1[0]->g_first_name}}" placeholder="First Name" required>
        
        <script type="text/javascript">
          document.getElementById("firstName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="middleName">Middle Name<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="middleName" name="middleName" value="{{$user1[0]->g_middle_name}}" placeholder="Middle Name" required>
        
        <script type="text/javascript">
          document.getElementById("middleName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="lastName">Last Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="{{$user1[0]->g_last_name}}" placeholder="Last Name" required>
        
        <script type="text/javascript">
          document.getElementById("lastName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12" id="mothersName" style="display: block">
        <label for="motherMaidenName">Mother's Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="motherMaidenName" name="motherMaidenName" value="{{$user1[0]->mother_name}}" placeholder="Mother’s Name">
        
        <script type="text/javascript">
          document.getElementById("motherMaidenName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="mobile">Mobile No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="10" class="form-control" id="mobile" oninput="mob()" onkeypress="return event.charCode >= 48 && event.charCode<=57" name="mobile" value="{{$user1[0]->g_mobile}}" placeholder="Mobile No" required>
        <script type="text/javascript">
          function mob() {
            var mobno = document.getElementById('mobile');
            if(mobno.value.length != 10){
              mobno.setCustomValidity('Enter proper Mobile No.');
              return false;
            }
            else{
             mobno.setCustomValidity('');
              return true; 
            }
          }

        </script>
        
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="occupation">Occupation<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="occupation" name="occupation" value="{{$user1[0]->g_occupation}}" placeholder="Occupation" required>
        
        <script type="text/javascript">
          document.getElementById("occupation").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-12 col-sm-12">
        <label for="office_address">Office Address<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="office_address" name="office_address" value="{{$user1[0]->g_office_address}}" placeholder="Office Address">
        
      </div>
      <div class="form-group col-md-4">
        <label for="office_tel_no">Office Telephone No<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" class="form-control" id="office_tel_no" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="office_tel_no" value="{{$user1[0]->g_office_tel_no}}" placeholder="Office Telephone No">
        
      </div>
      <div class="form-group col-md-4">
        <label for="qualification">Qualification<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="qualification" name="qualification" value="{{$user1[0]->g_qualification}}" placeholder="Qualification" required>
        <script type="text/javascript">
          $("#qualification").on("invalid", function (event) {
          event.target.setCustomValidity('Enter proper Qualification')
          }).bind('blur', function (event) {
          event.target.setCustomValidity('');                
          });
        </script>
        <script type="text/javascript">
          document.getElementById("qualification").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
      </div>
      <div class="form-group col-md-4">
        <label for="annualIncome">Family Annual Income<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" class="form-control" id="annualIncome" name="annualIncome" onkeypress="return event.charCode >=48 && event.charCode <= 57" value="{{$user1[0]->g_annual_income}}" placeholder="Enter Family Annual Income" required>  
        
      </div>
      {{-- radio button for dom or dom appl --}}
      <div class="form-group col-md-12 col-sm-12">
        <br>
        <label for="lastName" style="font-size: 18px;">Do you have Domicile?</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @if($parent_domicile == "true")
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes" checked>&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no">&nbsp;No&nbsp;&nbsp;
         <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na">&nbsp;N.A.&nbsp;&nbsp;
        @elseif($parent_domicile == "false")
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes">&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no" checked>&nbsp;No&nbsp;&nbsp;
        <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na">&nbsp;N.A.&nbsp;&nbsp;
        @else
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes">&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no">&nbsp;No&nbsp;&nbsp;
        <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na" checked>&nbsp;N.A.&nbsp;&nbsp;
        @endif
        <label for="lastName" style="font-size: 14px; color: red;">(Compulsory for Type B Candidate)</label>
      </div>
      <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('dom_yes').checked) {
                document.getElementById('parentDom').style.display = 'block';
                document.getElementById('parentDomAppl').style.display = 'none';
                // dom 
                document.getElementById('parentDomecileNo').required = true;
                document.getElementById('dateOfParentDomecile').required = true;
                // dom appl
                document.getElementById('parentDomecileApplicationNo').required = false;
                document.getElementById('applicationDateOfParentDomecile').required = false;
            }
            if (document.getElementById('dom_no').checked) {
                document.getElementById('parentDom').style.display = 'none';
                document.getElementById('parentDomAppl').style.display = 'block';
                // dom 
                document.getElementById('parentDomecileNo').required = false;
                document.getElementById('dateOfParentDomecile').required = false;
                // dom appl
                document.getElementById('parentDomecileApplicationNo').required = true;
                document.getElementById('applicationDateOfParentDomecile').required = true;
            }
            if (document.getElementById('dom_na').checked) {
                document.getElementById('parentDom').style.display = 'none';
                document.getElementById('parentDomAppl').style.display = 'none';
                // dom 
                document.getElementById('parentDomecileNo').required = false;
                document.getElementById('dateOfParentDomecile').required = false;
                // dom appl
                document.getElementById('parentDomecileApplicationNo').required = false;
                document.getElementById('applicationDateOfParentDomecile').required = false;
            }
        }
      </script>
      <div id="parentDom">
        <div class="form-group col-md-6 col-sm-12">
          <label for="parentDomecileNo">Parent’s Domicile No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label> 
          <input type="text" class="form-control" id="parentDomecileNo" name="parentDomecileNo" value="{{$user1[0]->parent_domicile_no}}" placeholder="Parent’s Domicile No">
          
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="dateOfParentDomecile">Date of Parent’s Domicile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="date"  class="form-control" id="dateOfParentDomecile" name="dateOfParentDomecile" value="{{$user1[0]->parent_domicile_date}}" placeholder="Date of Parent’s Domicile">
        </div>
      </div>
      <div id="parentDomAppl" style="display: none;">
        <div class="form-group col-md-6 col-sm-12">
          <label for="parentDomecileApplicationNo">Parent’s Domicile Application No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="parentDomecileApplicationNo" name="parentDomecileApplicationNo" value="{{$user1[0]->parent_domicile_appl_no}}"placeholder="Parent’s Domicile Application No">
          
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="applicationDateOfParentDomecile">Application Date of Parent’s Domicile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="date"  class="form-control" id="applicationDateOfParentDomecile" name="applicationDateOfParentDomecile" value="{{$user1[0]->parent_domicile_appl_date}}" placeholder="Application Date of Parent’s Domicile">
        </div>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <a  href="{{ route('mca_personal_details') }}">
        <button type="button" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Back</button>
        </a>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <button type="submit" class="btn btn-view btn-primary" id="submitForm" name="submit" style="width: 100%" >Save And Continue</button> 
      </div>
    </form>
  </div>
</div>
</body>
<script type="text/javascript">
        $(function () {
            // When your submit button is clicked

            $("#submitForm").click(function (e) {

               var a="{{$user1[0]->candidate_type}}";
              
                // If it is not checked, prevent the default behavior (your submit)
                if ($("input[type='radio'][name='dom']:checked").val()=="na" && a=='B') {
                    alert("For Type B Students parents domicile is required");
                    //jQuery.noConflict(); 
                    //$('#cetorjee').modal({'backdrop': 'static'});
                    //$('#cetorjee').modal('show'); 
                    //alert('Helllo');
                    e.preventDefault();
                }
            });
        });
      </script>
<br><br><br>
@endsection