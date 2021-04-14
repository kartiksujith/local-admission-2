@extends('layout.newapp6')
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>
@section('content')
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
      <!-- <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('dse_dte_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Details</h5>
            </a>
            <a href="{{ route('dse_academic_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Academic Details</h5>
            </a>
            <a href="{{ route('dse_personal_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Personal Details</h5>
            </a>
            <a href="{{ route('dse_guardian_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Guardian Details</h5>
            </a>
            <a href="{{ route('dse_contact_details') }}" class="list-group-item active">
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
            <a href="{{ route('dse_final_submit') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside>
      </div> -->
      <div class="row-md-2"></div>
    </div>
  </div>
  <script type="text/javascript">
    function blocking(status,chk){
        if(chk == "true")
        {
            document.getElementById('isSame').checked = true;
            document.getElementById('corresAddress').style.display = "none";
        }
        else
        {
            document.getElementById('isSame').checked = false;
        }
        if(status == "Outstation")
        {
           document.getElementById('notLocalRes').style.display = "block";
           document.getElementById('localGuardianName').disabled = false;
           document.getElementById('localGuardianAddressLine1').disabled = false;
           document.getElementById('localGuardianAddressLine2').disabled = false;
           document.getElementById('localGuardianAdreessCity').disabled = false;
           document.getElementById('localGuardianAdreessDristict').disabled = false;
           document.getElementById('localGuardianAddressState').disabled = false;
           document.getElementById('localGuardianAddressPincode').disabled = false;
        }
        else
        {
           document.getElementById('notLocalRes').style.display = "none";
           document.getElementById('localGuardianName').disabled = false;
           document.getElementById('localGuardianAddressLine1').disabled = false;
           document.getElementById('localGuardianAddressLine2').disabled = false;
           document.getElementById('localGuardianAdreessCity').disabled = false;
           document.getElementById('localGuardianAdreessDristict').disabled = false;
           document.getElementById('localGuardianAddressState').disabled = false;
           document.getElementById('localGuardianAddressPincode').disabled = false;
           document.getElementById('localGuardianName').value= "";
           document.getElementById('localGuardianAddressLine1').value= "";
           document.getElementById('localGuardianAddressLine2').value= "";
           document.getElementById('localGuardianAdreessCity').value= "";
           document.getElementById('localGuardianAdreessDristict').value= "";
           document.getElementById('localGuardianAddressState').value= "";
           document.getElementById('localGuardianAddressPincode').value= "";
       }
       
    }
  </script>
  <body onload = "blocking('{{$user1[0]->resident_of}}','{{$permanent}}')" id="example">
    <div class="col-md-12 col-sm-12">

      <h1>Contact Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" onclick="myFunction()" data-target="#dteContact" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
        <script>
function myFunction() {
  var a=document.getElementById("dteContact");
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
      <div class="modal " id="dteContact" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Contact Details </h4>
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
                    <td>Permanent Address</td>
                    <td>Please enter your permanent address.</td>
                    <td>Fill details in the respective boxes correctly.</td>
                  </tr>
                  <tr>
                    <td>Is Correspondence Addess same as Permanent Address?</td>
                    <td>Select this if your permanent and correspondence address is same. Your correspondence address will be automatically filled.</td>
                    <td>Tick the Checkbox.</td>
                  </tr>
                  <tr>
                    <td>Correspondence Address</td>
                    <td>This address will be used to get in touch with you if required</td>
                    <td>Fill details in the respective boxes correctly.</td>
                  </tr>
                  <tr>
                    <td>Is Candidate resident of outstation?</td>
                    <td>Select Local if your permanent address is in Mumbai or Outstation if you reside in other parts of India.</td>
                    <td>Select one of the two options.</td>
                  </tr>
                  <tr>
                    <td>Local Guardian Name and Address</td>
                    <td>Fill these details if you are from other parts of India. These details are compulsory for <font style="font-weight: bold;">OUTSTATION</font> students.</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Contact Details-Phone number:</td>
                    <td>Please do not use STD codes while filling up telephone details.</td>
                    <td></td>
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
      @if($user1[0]->is_contact_completed==0)
      <script type="text/javascript">
       $(window).on('load', function () {
          
            $('#dteContact').modal('show');
        });
      </script>
      @endif
      <!---------------------------------Modal Close------------------------------------------>
      <form method="post" action="{{ route('dse_contact_details') }}">
        {{ csrf_field() }}
        <div class="form-group col-md-12 col-sm-12">
            <center><h4 style="font-weight: bold;">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="dteId">DTE ID</label>
          <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}" placeholder="DTE ID" disabled>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label style="font-size: 18px;">Permanent Address</label>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="permanentAddressLine1">Address Line 1<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressLine1" name="permanentAddressLine1" value="{{$user1[0]->permanent_address_line1}}" placeholder="Room number / Apartment name / Plot number" required>
          
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="permanentAddressLine2">Address Line 2<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressLine2" name="permanentAddressLine2" value="{{$user1[0]->permanent_address_line2}}" placeholder="Landmark / Street name" required>
          
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="permanentAddressCity">City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressCity" name="permanentAddressCity" value="{{$user1[0]->permanent_city}}" placeholder="Enter City" required>
         
          <script type="text/javascript">
          document.getElementById("permanentAddressCity").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="permanentAddressDistrict">District<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressDistrict" name="permanentAddressDistrict" value="{{$user1[0]->permanent_district}}" placeholder="Enter District" required>
         
          <script type="text/javascript">
          document.getElementById("permanentAddressDistrict").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-4 col-sm-12">
          <label for="permanentAddressState">State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressState" name="permanentAddressState" value="{{$user1[0]->permanent_state}}" placeholder="Enter State" required>
         
          <script type="text/javascript">
          document.getElementById("permanentAddressState").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="permanentAddressPincode">Pincode<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text"  oninput="checkpin()"  onkeyup="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="6" class="form-control"  id="permanentAddressPincode" name="permanentAddressPincode" value="{{$user1[0]->permanent_pincode}}"  placeholder="Enter Pincode" required>
          <script type="text/javascript">
          function checkpin(){     
              var pincode=document.getElementById('permanentAddressPincode');
              
              if(pincode.value!=""){
            if (pincode.value.length != 6){
              // alert(pincode.value.length);
             document.getElementById('permanentAddressPincode').setCustomValidity('Enter a proper Pincode.');
              return false;
            }
            else{
              // alert("hello");
              document.getElementById('permanentAddressPincode').setCustomValidity('');
              // return true;
            }
          }
        }          
        </script>
          
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="permanentAddressNearestRailwayStation">Nearest Railway Station<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="permanentAddressNearestRailwayStation" name="permanentAddressNearestRailwayStation" value="{{$user1[0]->permanent_nearest_rail_station}}" placeholder="Nearest Railway Station" required>
          
          <script type="text/javascript">
          document.getElementById("permanentAddressNearestRailwayStation").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label style="font-size: 15px;">
            Is Correspondence Address same as Permanent Address:  
            &nbsp;
          </label>
          <label class="checkbox-inline">
          @if($permanent == "true" )
          <input type="checkbox" id="isSame" name="isSame" value="Yes" onload="fillAddress()" onclick="fillAddress()" checked>Yes
          @else
          <input type="checkbox" id="isSame" name="isSame" value="yes" onclick="fillAddress()" >Yes
          @endif
          </label>
          <script type="text/javascript">
            function fillAddress() {
               if (document.getElementById('isSame').checked) {
                  document.getElementById('corresAddress').style.display = "none";
                  document.getElementById('currentAddressLine1').value = document.getElementById('permanentAddressLine1').value;
                //   document.getElementById('currentAddressLine1').disabled = true;
                  document.getElementById('currentAddressLine1').readonly = true;
                  document.getElementById('currentAddressLine2').value = document.getElementById('permanentAddressLine2').value;
                //   document.getElementById('currentAddressLine2').disabled = true;
                  document.getElementById('currentAddressLine2').readonly = true;
                  document.getElementById('currentAddressCity').value = document.getElementById('permanentAddressCity').value;
                //   document.getElementById('currentAddressCity').disabled = true;
                  document.getElementById('currentAddressCity').readonly = true;
                  document.getElementById('currentAddressDistrict').value = document.getElementById('permanentAddressDistrict').value;
                //   document.getElementById('currentAddressDistrict').disabled = true;
                  document.getElementById('currentAddressDistrict').readonly = true;
                  document.getElementById('currentAddressState').value = document.getElementById('permanentAddressState').value;
                //   document.getElementById('currentAddressState').disabled = true;
                  document.getElementById('currentAddressState').readonly = true;
                  document.getElementById('currentAddressPincode').value = document.getElementById('permanentAddressPincode').value;
                //   document.getElementById('currentAddressPincode').disabled = true;
                  document.getElementById('currentAddressPincode').readonly = true;
                  document.getElementById('currentAddressNearestRailwayStation').value = document.getElementById('permanentAddressNearestRailwayStation').value;
                //   document.getElementById('currentAddressNearestRailwayStation').disabled = true;
                  document.getElementById('currentAddressNearestRailwayStation').readonly = true;
                  
               }
               else{
                  document.getElementById('corresAddress').style.display = "block";
                  document.getElementById('currentAddressLine1').value = "";
                //   document.getElementById('currentAddressLine1').disabled = false;
                  document.getElementById('currentAddressLine1').readOnly = false;
                  document.getElementById('currentAddressLine2').value = "";
                //   document.getElementById('currentAddressLine2').disabled = false;
                  document.getElementById('currentAddressLine2').readOnly = false;
                  document.getElementById('currentAddressCity').value = "";
                //   document.getElementById('currentAddressCity').disabled = false;
                  document.getElementById('currentAddressCity').readOnly = false;
                  document.getElementById('currentAddressDistrict').value = "";
                //   document.getElementById('currentAddressDistrict').disabled = false;
                  document.getElementById('currentAddressDistrict').readOnly = false;
                  document.getElementById('currentAddressState').value = "";
                //   document.getElementById('currentAddressState').disabled = false;
                  document.getElementById('currentAddressState').readOnly = false;
                  document.getElementById('currentAddressPincode').value = "";
                //   document.getElementById('currentAddressPincode').disabled = false;
                  document.getElementById('currentAddressPincode').readOnly = false;
                  document.getElementById('currentAddressNearestRailwayStation').value = "";
                //   document.getElementById('currentAddressNearestRailwayStation').disabled = false;
                  document.getElementById('currentAddressNearestRailwayStation').readOnly = false;
            
               }
            }
          </script>
        </div>
        <div id="corresAddress">
        <div class="form-group col-md-12 col-sm-12">
          <label style="font-size: 18px;">Correspondence Address</label>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="currentAddressLine1">Address Line 1<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressLine1" name="currentAddressLine1" value="{{$user1[0]->correspondance_address_line1}}" placeholder="Room number / Apartment name / Plot number" required>
         
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="currentAddressLine2">Address Line 2<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressLine2" name="currentAddressLine2" value="{{$user1[0]->correspondance_address_line2}}" placeholder="Landmark / Street name" required>
         
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="currentAddressCity">City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressCity" name="currentAddressCity" value="{{$user1[0]->correspondance_city}}" placeholder="Enter City" required>
         
          <script type="text/javascript">
          document.getElementById("currentAddressCity").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="currentAddressDistrict">District<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressDistrict" name="currentAddressDistrict" value="{{$user1[0]->correspondance_district}}" placeholder="Enter District" required>
          
          <script type="text/javascript">
          document.getElementById("currentAddressDistrict").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="currentAddressState">State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressState" name="currentAddressState" value="{{$user1[0]->correspondance_state}}" placeholder="Enter State" required>
          
          <script type="text/javascript">
          document.getElementById("currentAddressState").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="currentAddressPincode">Pincode<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" oninput="checkcurrentaddresspin()" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  maxlength="6" class="form-control" id="currentAddressPincode"  name="currentAddressPincode" value="{{$user1[0]->correspondance_pincode}}"  placeholder="Pincode" required>
          <script type="text/javascript">
             function checkcurrentaddresspin() {
          var currentAddressPincode=document.getElementById("currentAddressPincode");     
          if(currentAddressPincode.value!=""){   
            if (currentAddressPincode.value.length != 6) {                 
            document.getElementById("currentAddressPincode").setCustomValidity('please enter proper 6 digit pincode ');  
             currentAddressPincode.focus();
             return false;
            }
             else{
              
             currentAddressPincode.setCustomValidity('');
              
            }
           }
        }
          </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="currentAddressNearestRailwayStation">Nearest Railway Station<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="currentAddressNearestRailwayStation" name="currentAddressNearestRailwayStation" value="{{$user1[0]->correspondance_nearest_rail_station}}"  placeholder="Nearest Railway Station" required>
          
          <script type="text/javascript">
          document.getElementById("currentAddressNearestRailwayStation").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <br>
          <label style="font-size: 18px;">
          Is Candidate resident of outstation:  
          <br>
          </label>
          @if($user1[0]->resident_of == "Local") 
          <input type="radio" id="localOutstationL" name="localOutstation" value="Local" onload="notLocal()" onclick="notLocal()" checked>Local &nbsp;&nbsp;&nbsp;
          <input type="radio" id="localOutstationO" name="localOutstation" value="Outstation" onclick="notLocal()">Outstation
          @elseif($user1[0]->resident_of == "Outstation")
          <input type="radio" id="localOutstationL" name="localOutstation" value="Local" onclick="notLocal()">Local &nbsp;
          <input type="radio" id="localOutstationO" name="localOutstation" value="Outstation" onclick="notLocal()" checked>Outstation
          @elseif($user1[0]->resident_of == "Outstation")
          @else
          <input type="radio" id="localOutstationL" name="localOutstation" value="Local" onclick="notLocal()">Local &nbsp;
          <input type="radio" id="localOutstationO" name="localOutstation" value="Outstation" onclick="notLocal()" checked>Outstation
          @endif     
          <script type="text/javascript">
            function notLocal() {
                
               if (document.getElementById('localOutstationL').checked) {
                    document.getElementById('notLocalRes').style.display = "none";
                    document.getElementById('localGuardianName').disabled = true;
                    document.getElementById('localGuardianAddressLine1').disabled = true;
                    document.getElementById('localGuardianAddressLine2').disabled = true;
                    document.getElementById('localGuardianAdreessCity').disabled = true;
                    document.getElementById('localGuardianAdreessDristict').disabled = true;
                    document.getElementById('localGuardianAddressState').disabled = true;
                    document.getElementById('localGuardianAddressPincode').disabled = true;
                    // outstation
                    document.getElementById('localGuardianName').required = false;
                    document.getElementById('localGuardianAddressLine1').required = false;
                    document.getElementById('localGuardianAddressLine2').required = false;
                    document.getElementById('localGuardianAdreessCity').required = false;
                    document.getElementById('localGuardianAdreessDristict').required = false;
                    document.getElementById('localGuardianAddressState').required = false;
                    document.getElementById('localGuardianAddressPincode').required = false;
               }
               if (document.getElementById('localOutstationO').checked) {
                   document.getElementById('notLocalRes').style.display = "block";
                  
                    document.getElementById('localGuardianName').disabled = false;
                    document.getElementById('localGuardianAddressLine1').disabled = false;
                    document.getElementById('localGuardianAddressLine2').disabled = false;
                    document.getElementById('localGuardianAdreessCity').disabled = false;
                    document.getElementById('localGuardianAdreessDristict').disabled = false;
                    document.getElementById('localGuardianAddressState').disabled = false;
                    document.getElementById('localGuardianAddressPincode').disabled = false;
                    // outstation
                    document.getElementById('localGuardianName').required = true;
                    document.getElementById('localGuardianAddressLine1').required = true;
                    document.getElementById('localGuardianAddressLine2').required = true;
                    document.getElementById('localGuardianAdreessCity').required = true;
                    document.getElementById('localGuardianAdreessDristict').required = true;
                    document.getElementById('localGuardianAddressState').required = true;
                    document.getElementById('localGuardianAddressPincode').required = true;
               }
            }
          </script>
        </div>
        <div id="notLocalRes" style="display:none;">
        <div class="form-group col-md-12 col-sm-12">
          <label for="localGuardianName">Local Guadian Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianName" name="localGuardianName" value="{{$user1[0]->local_guardian_name}}" placeholder="Local Guadian Name" <?php // if( {{$user1[0]->resident_of == "Local") echo 'disabled' ?>>
          
          <script type="text/javascript">
          document.getElementById("localGuardianName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label>Local Guadian Address<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="localGuardianAddressLine1">Address Line 1<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianAddressLine1" name="localGuardianAddressLine1" value="{{$user1[0]->local_guardian_address_line1}}" placeholder="Room number / Apartment name / Plot number" <?php // if( $user1[0]->resident_of == "Local") echo 'disabled' ?>>
        
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <label for="localGuardianAddressLine2">Address Line 2<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianAddressLine2" name="localGuardianAddressLine2" value="{{$user1[0]->local_guardian_address_line2}}" placeholder="Landmark / Street name"  <?php //if( $user1[0]->resident_of == "Local") echo 'disabled' ?>>
          
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="localGuardianAdreessCity">City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianAdreessCity" name="localGuardianAdreessCity" value="{{$user1[0]->local_guardian_city}}" placeholder="Enter City" <?php // if( $user1[0]->resident_of == "Local") echo 'disabled' ?>>
          
          <script type="text/javascript">
          document.getElementById("localGuardianAdreessCity").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="localGuardianAdreessDristict">District<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianAdreessDristict" name="localGuardianAdreessDristict" value="{{$user1[0]->local_guardian_city}}" placeholder="Enter District" <?php //if($user1[0]->resident_of == "Local") echo 'disabled' ?>>
          
          <script type="text/javascript">
          document.getElementById("localGuardianAdreessDristict").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="localGuardianAddressState">State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="localGuardianAddressState" name="localGuardianAddressState" value="{{$user1[0]->local_guardian_state}}" placeholder="Enter State" <?php //if( $user1[0]->resident_of == "Local") echo 'disabled' ?>>
          
          <script type="text/javascript">
          document.getElementById("localGuardianAddressState").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="localGuardianAddressPincode">Pincode<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" oninput="checkguardianaddresspin()" class="form-control" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="6" id="localGuardianAddressPincode" name="localGuardianAddressPincode" value="{{$user1[0]->local_guardian_pincode}}"  placeholder="Pincode" <?php //if($user1[0]->resident_of == "Local") echo 'disabled' ?>>
          <script type="text/javascript">
             function checkguardianaddresspin() {
          var localpincode=document.getElementById("localGuardianAddressPincode");     

          if(localpincode.value!=""){   
            if (localpincode.value.length != 6){                 
             document.getElementById("localGuardianAddressPincode").setCustomValidity('Enter a proper Pincode.');
              return false;             
            }
            else{
              
             localpincode.setCustomValidity('');
              
            }
          }
        }
          </script>
          
        </div>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <a  href="{{ route('dse_guardian_details') }}">
          <button type="button" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Back</button>
          </a>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <button type="submit" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Save And Continue</button>
          </a>
        </div>
      </form>
    </div>

  </body>
</div>
<style type="text/css">
  @media (max-width: 1166px) and (min-width: 1022px){

    .navbar{
    height: 100px;    
    }
  }

  
</style>
@endsection