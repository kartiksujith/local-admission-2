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
<body onload = "load('{{$domicile}}')">
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
   function load(r)
   {
   
            if (r == "true") {
                document.getElementById('applicationNumber').value = '';
                document.getElementById('applictionDate').value = '';
            }
            if (r == "false") {
                document.getElementById('domicileNumber').value = '';
                document.getElementById('domicileDate').value = '';
            }
            if (r == "na") {
                document.getElementById('applicationNumber').value = '';
                document.getElementById('applictionDate').value = '';
                document.getElementById('domicileNumber').value = '';
                document.getElementById('domicileDate').value = '';
            }
        
    yesnoCheck()
   }
 </script>
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
                    <li ><a href="{{ route('me_dte_details') }} " ><i class="fa fa-fw fa-home";></i>&nbspDTE Details&nbsp</a></li>
                </div>
              </div>
              
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_academic_details') }}" ><i class="fa fa-fw fa-home";></i>&nbspAcademic Details&nbsp</a></li>
               </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li class="active"><a href="{{ route('me_personal_details') }}" ><i class="fa fa-fw fa-home";></i>&nbspPersonal Details&nbsp</a></li>
               </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_guardian_details') }}" ><i class="fa fa-fw fa-home"></i>&nbspGuardian Details&nbsp</a></li>
              </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_contact_details') }}" ><i class="fa fa-fw fa-home"></i>Contact Details&nbsp</a></li>
              </div>
              </div>
              
              @if(session('log_acap') == "yes")
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_acap_document_upload') }}"><i class="fa fa-fw fa-database"></i>&nbsp&nbspDocument Upload&nbsp&nbsp&nbsp</a></li>
              </div>
              @endif
              @if(session('log_acap') != "yes")
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_document_upload') }}"><i class="fa fa-fw fa-database"></i>&nbsp&nbsp&nbspDocument Upload&nbsp&nbsp&nbsp</a></li>
              </div>
              </div>
              @endif
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_admission_payment') }}"><i class="fa fa-fw fa-database"></i>&nbsp&nbspPayment&nbsp</a></li>
              </div>
              </div>
              
                <div class="col-md" >
                  <div class="abc">
                           <li><a href="{{ route('me_profile') }} " ><i class="fa fa-fw fa-user"></i>&nbsp&nbsp &nbspProfile</a></li>
          
                </div>
                </div>
               
                <div class="col-md" >
                    <div class="abc">
                        <li><a href="{{ route('logout') }} " ><i class="fa fa-fw fa-power-off"></i>&nbsp&nbsp &nbspLogout</a></li>
                  </div>
                  </div>
              </nav>
            </header> -->
            <!--nav start--> 
<div class="container">
  <div class="col-md-2">
    <div class="col">
     
     <!--  <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('me_dte_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">DTE Details</h5>
            </a>
            <a href="{{ route('me_academic_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Academic Details</h5>
            </a>
            <a href="{{ route('me_personal_details') }}" class="list-group-item active">
              <h5 class="list-group-item-heading">Personal Details</h5>
            </a>
            <a href="{{ route('me_guardian_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Guardian Details</h5>
            </a>
            <a href="{{ route('me_contact_details') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Contact Details</h5>
            </a>
            @if(session('log_acap') == "yes")
            <a href="{{ route('me_acap_document_upload') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
             @endif
            @if(session('log_acap')!="yes")
            <a href="{{ route('me_document_upload') }}" class="list-group-item ">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
            <a href="{{ route('me_admission_payment') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Payment</h5>
            </a>
          @endif
            <a href="{{ route('me_final_submit') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside>
      </div> -->
      <div class="row-md-2"></div>
    </div>
  </div>
  <div class="col-md-12 col-sm-12">
       
    <h1>Personal Details&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger"  onclick="myFunction()" data-toggle="modal" data-target="#dtePersonal" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
      <script>
function myFunction() {
  var a=document.getElementById("dtePersonal");
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
    <div class="modal " id="dtePersonal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Personal Details</h4>
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
                  <td>Name as on Marksheet</td>
                  <td>Fill your name as shown on your HSC Marksheet. <br> (This format will differ for each person.)</td>
                  <td>Surname Firstname Middlename</td>
                </tr>
                <tr>
                  <td>Do you have domicile?</td>
                  <td>This document is a <font style="font-weight: bold;">PROOF OF BIRTH</font> <br> For TYPE (A,B,C,D,E) - should fill if you dont have birth certificate.</td>
                  <td>Select <font style="font-weight: bold;">YES</font> if you have domicile. <br> Select <font style="font-weight: bold;">NO</font> if you have domicile application.</td>
                </tr>
                <tr>
                  <td>UID ( Adhar NUmber )</td>
                  <td>Enter 12 digit adhar number in this field. It is compulsory.</td>
                  <td>123412341234</td>
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
    @if($user1[0]->is_personal_completed==0)
    <script type="text/javascript">
      $(window).on('load',function(){
          $('#dtePersonal').modal('show');
      });
    </script>
    @endif
    <!---------------------------------Modal Close------------------------------------------>
    <form method="post" action="{{ route('me_personal_details') }}">
      {{ csrf_field() }}
      <div class="form-group col-md-12 col-sm-12">
        <label for="dteId">DTE ID</label>
        <input type="text" class="form-control" id="dteId" name="dteId" value = "{{$user1[0]->dte_id}}" placeholder=" DTE ID" disabled>
      </div>
      <div class="form-group col-md-12 col-sm-12">
        <label for="nameAsOnMarksheet">Name as on Marksheet<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="nameAsOnMarksheet" name="nameAsOnMarksheet" value = "{{$user1[0]->name_on_marksheet}}" placeholder="Name as on Marksheet" required>
        
        <script type="text/javascript">
              document.getElementById("nameAsOnMarksheet").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
      </div>
      <div class="form-group  col-md-12 col-sm-12">
        <label style="font-size: 18px;">Gender<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>&nbsp;&nbsp;&nbsp;
      
        @foreach($genders as $key=>$gender)
        @if( $gender != $user1[0]->gender OR $gender == "null")
        <input type="radio" id="{{$key}}" name="gender" value="{{$gender}}">{{$key}}&nbsp;&nbsp;
        @endif
        @if( $gender == $user1[0]->gender )
        <input type="radio"  id="{{$key}}" name="gender" value="{{$gender}}" checked>{{$key}}&nbsp;&nbsp;
        @endif
        @endforeach
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="dob">Date Of Birth<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="date" class="form-control" id="dob" oninput="date_of_birth()" name="dob"  value = "{{$user1[0]->date_of_birth}}" placeholder="Date Of Birth" required>
        <script type="text/javascript">
          function date_of_birth() {
          var dob=document.getElementById('dob').value;
          var today = new Date(); 
          var selected_date= new Date(dob);
          if(selected_date.getTime() >today.getTime() ){

          // alert('Enter proper date');
          document.getElementById("dob").setCustomValidity("enter proper date");
          return false;
            }
          }
        </script>

      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="placeOfBirthCity">City Of Birth<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="placeOfBirthCity" name="placeOfBirthCity" value = "{{$user1[0]->place_of_birth_city}}" placeholder="Enter City" required>
        
        <script type="text/javascript">
        document.getElementById("placeOfBirthCity").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="placeOfBirthState">State Of Birth<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="placeOfBirthState" name="placeOfBirthState" value="{{$user1[0]->place_of_birth_state}}" placeholder="Enter State" required>
        
        <script type="text/javascript">
        document.getElementById("placeOfBirthState").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      
      <div class="form-group col-md-3 col-sm-12">
        <label for="motherTongue">Mother Tongue<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="motherTongue" name="motherTongue" value="{{$user1[0]->mother_tongue}}" placeholder="Mother Tongue" required>
        
        <script type="text/javascript">
        document.getElementById("motherTongue").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="nationality">Nationality<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="nationality" name="nationality" value = "{{$user1[0]->nationality}}" placeholder="Nationality" required>
        
        <script type="text/javascript">
        document.getElementById("nationality").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="religion">Religion<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="religion" name="religion" value="{{$user1[0]->religion}}" placeholder="Religion" required>
        
        <script type="text/javascript">
        document.getElementById("religion").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      <div class="form-group col-md-3 col-sm-12">
        <label for="casteTribe">Caste / Tribe<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="casteTribe" name="casteTribe" value = "{{$user1[0]->caste_tribe}}" placeholder="Caste/tribe" required>
        
        <script type="text/javascript">
        document.getElementById("casteTribe").onkeypress=function(e)
        { 
        var e=window.event || e 
        var keyunicode=e.charCode || e.keyCode 
        return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
        }
        </script>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="bloodGroup">Blood Group<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="bloodGroup" name="bloodGroup" required>
          @foreach($blood_groups as $key=>$bloodGroup)
          @if( $key == $user1[0]->blood_group )
          <option value="{{$key}}" selected>{{$bloodGroup}}</option>
          @else
          <option value="{{$key}}">{{$bloodGroup}}</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="uid">UID ( Adhar Number )<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="uid" name="uid" maxlength="12" value="{{$user1[0]->uid }}" oninput="check1()" placeholder="Enter 12 digit Adhar Number" required>
        <script type="text/javascript">
           function check1() {
            var uid=document.getElementById('uid');
            $(uid).val($(uid).val().replace(/[^\d]/ig, ''));
              var len=document.getElementById('uid').value;       
       var passcode_input = document.querySelector("#uid");
       if (len.length != 12) {
           passcode_input.setCustomValidity("Please enter valid aadhar card Number !!");
           return false;
       } else {
           passcode_input.setCustomValidity("");
       }               
           }
          </script>
      </div>
      {{-- radio button for dom or dom appl --}}
      <div class="form-group col-md-12 col-sm-12">
        <label for="lastName" style="font-size: 18px;">Do you have Domicile</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @if($domicile == "true")
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes" checked>&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no">&nbsp;No&nbsp;&nbsp;
        <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na">&nbsp;N.A.&nbsp;&nbsp;
        @elseif($domicile == "false")
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes">&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no" checked>&nbsp;No&nbsp;&nbsp;
        <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na">&nbsp;N.A.&nbsp;&nbsp;
        @else
        <input type="radio"  id="dom_yes" name="dom" onchange="yesnoCheck()" value="yes">&nbsp;Yes&nbsp;&nbsp;
        <input type="radio"  id="dom_no" name="dom" onchange="yesnoCheck()" value="no">&nbsp;No&nbsp;&nbsp;
        <input type="radio"  id="dom_na" name="dom" onchange="yesnoCheck()" value="na" checked>&nbsp;N.A.&nbsp;&nbsp;
        @endif
      </div>
      <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('dom_yes').checked) {
                document.getElementById('stdDomicile').style.display = 'block';
                document.getElementById('stdDomicileAppl').style.display = 'none';
                // dom 
                document.getElementById('domicileNumber').required = true;
                document.getElementById('domicileDate').required = true;
                // dom appl
                document.getElementById('applicationNumber').required = false;
                document.getElementById('applictionDate').required = false;
            }
            if (document.getElementById('dom_no').checked) {
                document.getElementById('stdDomicile').style.display = 'none';
                document.getElementById('stdDomicileAppl').style.display = 'block';
                // dom 
                document.getElementById('domicileNumber').required = false;
                document.getElementById('domicileDate').required = false;
                // dom appl
                document.getElementById('applicationNumber').required = true;
                document.getElementById('applictionDate').required = true;
            }
            if (document.getElementById('dom_na').checked) {
                document.getElementById('stdDomicile').style.display = 'none';
                document.getElementById('stdDomicileAppl').style.display = 'none';
                // dom 
                document.getElementById('domicileNumber').required = false;
                document.getElementById('domicileDate').required = false;
                // dom appl
                document.getElementById('applicationNumber').required = false;
                document.getElementById('applictionDate').required = false;
            }
        }
      </script>
      <div id="stdDomicile">
        <div class="form-group col-md-6 col-sm-12">
          <label for="domicileNumber">Students Domicile No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="domicileNumber" name="domicileNumber" value = "{{$user1[0]->student_domicile_no}}" placeholder="Students Domicile No.">
         
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="domicileDate">Date of Students Domicile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="date" class="form-control" id="domicileDate" name="domicileDate" value = "{{$user1[0]->student_domicile_date}}" placeholder="Date of Students Domicile">
        </div>
      </div>
      <div id="stdDomicileAppl" style="display: none;">
        <div class="form-group col-md-6 col-sm-12">
          <label for="applicationNumber">Students Domicile Application No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" value = "{{$user1[0]->student_domicile_appl_no}}" placeholder="Students Domicile Application No.">
         
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <label for="applictionDate">Date of Application of Students Domicile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <input type="date" class="form-control" id="applictionDate" name="applictionDate" value = "{{$user1[0]->student_domicile_appl_date}}" placeholder="Date of Application of Students Domicile">
        </div>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <a  href="{{ route('me_academic_details') }}">
        <button type="button" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Back</button>
        </a>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <button type="submit" class="btn btn-view btn-primary" id="submit" name="submit" style="width: 100%" >Save And Continue</button>
        </a>
      </div>
    </form>
  </div>
</div>
</body>
<br><br><br>
@endsection