@extends('layout.newapp6')
@section('content')
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
</div>
<body  style="overflow: scroll;" onload="radioValue('{{$user1[0]->is_diploma}}','{{$user1[0]->is_new_or_old}}')">
<style>
  .displaynone{
              display: none;
          }
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
 --><script>
$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
</script>  

   <!-- nav bar start  -->
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
                    <li class="active"><a href="{{ route('me_academic_details') }}" ><i class="fa fa-fw fa-home";></i>&nbspAcademic Details&nbsp</a></li>
               </div>
              </div>
              <div class="col-md" >
                <div class="abc">
                    <li><a href="{{ route('me_personal_details') }}" ><i class="fa fa-fw fa-home";></i>&nbspPersonal Details&nbsp</a></li>
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
            </header>  -->
            
  <!-- navigation bar end  -->


  <script type="text/javascript">
    function radioValue(dh , cpp ) {
      // Diploma - HSC value on load check
     document.getElementById('hscotherBoard1').classList.add('displaynone');

      notDeclared();
      if ( dh == 'D' ) {
        document.getElementById('diplomaDetails').style.display = 'block';
        document.getElementById('hscDetails').style.display = 'none';
        document.getElementById('hscCollegeName').value = '';
        document.getElementById('hscBoard').value = '';
        document.getElementById('hscCollegeCity').value = '';
        document.getElementById('hscCollegeState').value = '';
        document.getElementById('hscBoard').value = '';
        document.getElementById('xiiObtainedMarks').value = '';
        document.getElementById('xiiMaximumMarks').value = '';
        document.getElementById('xiiPercentage').value = '';
      }
      if ( dh == 'H' ) {
        document.getElementById('diplomaDetails').style.display = 'none';
        document.getElementById('hscDetails').style.display = 'block';
        document.getElementById('diplomaCollegeName').value = '';
        document.getElementById('diplomaBoard').value = '';
        document.getElementById('diplomaCollegeCity').value = '';
        document.getElementById('diplomaCollegeState').value = '';
        document.getElementById('diplomaBranch').value = '';
        document.getElementById('diplomaObtainedMarks').value = '';
        document.getElementById('diplomaMaximumMarks').value = '';
        document.getElementById('diplomaPercentage').value = '';
      }
      // Degree values on load check
      if ( cpp == 'N') {
        // percentold values
        document.getElementById('degree_1_marks_obt').value = '';
        document.getElementById('degree_2_marks_obt').value = '';
        document.getElementById('degree_3_marks_obt').value = '';
        document.getElementById('degree_4_marks_obt').value = '';
        document.getElementById('degree_5_marks_obt').value = '';
        document.getElementById('degree_6_marks_obt').value = '';
        document.getElementById('degree_1_marks_max').value = '';
        document.getElementById('degree_2_marks_max').value = '';
        document.getElementById('degree_3_marks_max').value = '';
        document.getElementById('degree_4_marks_max').value = '';
        document.getElementById('degree_5_marks_max').value = '';
        document.getElementById('degree_6_marks_max').value = '';
        document.getElementById('oldAggrObtainedMarks').value = '';
        document.getElementById('oldAggrMaximumMarks').value = '';
        document.getElementById('oldAggrPercentage').value = '';
        //new
        document.getElementById('aggrObtainedMarks').required = true;
        document.getElementById('aggrMaximumMarks').required = true;
        document.getElementById('aggrPercentage').required = true;
        document.getElementById('finalCGPA').required = true;
        // old
        document.getElementById('degree_1_marks_obt').required = false;
        document.getElementById('degree_1_marks_max').required = false;
        document.getElementById('degree_2_marks_obt').required = false;
        document.getElementById('degree_2_marks_max').required = false;
        document.getElementById('degree_3_marks_obt').required = false;
        document.getElementById('degree_3_marks_max').required = false;
        document.getElementById('degree_4_marks_obt').required = false;
        document.getElementById('degree_4_marks_max').required = false;
        document.getElementById('degree_5_marks_obt').required = false;
        document.getElementById('degree_5_marks_max').required = false;
        document.getElementById('degree_6_marks_obt').required = false;
        document.getElementById('degree_6_marks_max').required = false;
        }
      if ( cpp == 'O') {
        // cgpanew values
        document.getElementById('aggrObtainedMarks').value = '';
        document.getElementById('aggrMaximumMarks').value = '';
        document.getElementById('aggrPercentage').value = '';
        document.getElementById('finalCGPA').value = '';
        // new
        document.getElementById('aggrObtainedMarks').required = false;
        document.getElementById('aggrMaximumMarks').required = false;
        document.getElementById('aggrPercentage').required = false;
        document.getElementById('finalCGPA').required = false;
        // old
        document.getElementById('degree_1_marks_obt').required = true;
        document.getElementById('degree_1_marks_max').required = true;
        document.getElementById('degree_2_marks_obt').required = true;
        document.getElementById('degree_2_marks_max').required = true;
        document.getElementById('degree_3_marks_obt').required = true;
        document.getElementById('degree_3_marks_max').required = true;
        document.getElementById('degree_4_marks_obt').required = true;
        document.getElementById('degree_4_marks_max').required = true;
        document.getElementById('degree_5_marks_obt').required = true;
        document.getElementById('degree_5_marks_max').required = true;
        document.getElementById('degree_6_marks_obt').required = true;
        document.getElementById('degree_6_marks_max').required = true;
        }
     
      yesnoCheck(dh);
      newoldCheck(cpp);

    }
  </script>
  <div class="container">
    <div class="col-md-2">
      <div class="col">
        <div class="row-md-2">
         
        </div>
        <!-- <div class="row-md-8">
          <aside>
            <div class="list-group">
              <a href="{{ route('me_dte_details') }}" class="list-group-item">
                <h5 class="list-group-item-heading">DTE Details</h5>
              </a>
              <a href="{{ route('me_academic_details') }}" class="list-group-item active">
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
              @if(session('log_acap') == "yes")
              <a href="{{ route('me_acap_document_upload') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Document Upload</h5>
              </a>
               @endif
              @if(session('log_acap')!="yes")
              <a href="{{ route('me_document_upload') }}" class="list-group-item">
                <h5 class="list-group-item-heading">Document Upload</h5>
              </a>
              @endif
              @if(session('log_acap')!="yes")
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
    <style type="text/css">
      #fieldset {
      min-width: 10px;
      padding: 0px;
      margin: 0;
      border: 10px;
      padding-bottom: 30px;
      }
    </style>
    <div class="col-md-12">
   
      
      <h1>Academic Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dteAccademic" id="myBtn"  onclick="myFunction()" style="font-weight: bold; border-radius: 100px">?</label></h1>
    
        <script>
function myFunction() {
  var a=document.getElementById("dteAccademic");
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
      <div class="modal " id="dteAccademic" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Academic Details</h4>
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
                    <td>SSC / X / Equivalent* Details</td>
                    <td>These details refer to 10th class / grade details.</td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>Is Diploma  or HSC</td>
                    <td>Detailed description provided in help section.</td>
                    <td>Click on red '?' to get more info</td>
                  </tr>
                  <tr>
                    <td>HSC / XII / Equivalent* Details</td>
                    <td>These details refer to 12th class / grade details.</td>
                    <td>Enter details if applicable</td>
                  </tr>
                  <tr>
                    <td>Diploma Details</td>
                    <td>These details refer to diploma details.</td>
                    <td>Enter Details if applicable</td>
                  </tr>
                  <tr>
                    <td>Degree Details</td>
                    <td>These details refer to Degree ie. graduation details.</td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>Degree Name</td>
                    <td>eg. BE </td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>Degree Branch Name</td>
                    <td>eg. Computer Engineering <br> Information Technology  <br> Electronics Engineering </td>
                    <td>Mandatory Details</td>
                  </tr>
                  <tr>
                    <td>University Type</td>
                    <td>Select the university type that you belong to.</td>
                    <td>HU(Home University)</td>
                  </tr>
                  <tr>
                    <td>CGPA System(New) / Percentage System(Old)</td>
                    <td>Detailed description provided in its help section.</td>
                    <td>Click on red '?' to get more info</td>
                  </tr>
                  <tr>
                    <td>Obtained Marks in Maths( First Year )</td>
                    <td>Enter marks of Mathematics subject from sem1 or sem 2.</td>
                    <td>50</td>
                  </tr>
                  <tr>
                    <td>Maximum Marks( Out Of )</td>
                    <td>Enter out of marks for the subject</td>
                    <td>100</td>
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
      @if($user1[0]->is_academic_completed==0)
      <script type="text/javascript">
        $(window).on('load',function(){
            $('#dteAccademic').modal('show');
        });
      </script>
      @endif
      <!---------------------------------Modal Close------------------------------------------>
      <form method="post" action="{{ route('me_academic_details') }}">
        {{ csrf_field() }}
        <div class="form-group col-md-12">
          <label for="dteId">DTE ID</label>
          <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}" placeholder=" DTE ID" disabled>
        </div>
        <div id="sscDetails">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">SSC / X / Equivalent* Details</legend>
            <div class="form-group col-md-6 col-sm-12">
              <label for="ForsscSchoolName">School Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscSchoolName" name="sscSchoolName" value="{{$user1[0]->x_school_name}}" required placeholder="Enter School name" required />
            <script type="text/javascript">
            document.getElementById("sscSchoolName").onkeypress=function(e)
            {   
            var e=window.event || e 
            var keyunicode=e.charCode || e.keyCode 
            return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
            }
        </script>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="sscBoard">Board Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscBoard" name="sscBoard" value="{{$user1[0]->x_board}}" required placeholder="Enter Board name" required>
             
              <script type="text/javascript">
              document.getElementById("sscBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="sscSchoolCity">School City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscSchoolCity" name="sscSchoolCity" value="{{$user1[0]->x_school_city}}" required placeholder="Enter City" required>
             
              <script type="text/javascript">
              document.getElementById("sscSchoolCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="sscSchoolState">School State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="sscSchoolState" name="sscSchoolState" value="{{$user1[0]->x_school_state}}" required placeholder="Enter State" required>
             
              <script type="text/javascript">
              document.getElementById("sscSchoolState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="xPassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select class="form-control" id="xPassingMonth" name="xPassingMonth" required>{{$user1[0]->x_passing_month}}
                @foreach($months as $key=>$month)
                @if( $user1[0]->x_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->x_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="xPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="xPassingYear" name="xPassingYear" class="form-control" required></select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->x_passing_year }};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("xPassingYear").innerHTML = options;
              </script>
            </div>

            <div id="xpercent">
              <script type="text/javascript">
                function xpercent() {
                   var o = parseInt(document.getElementById('xObtainedMarks').value);
                   var m = parseInt(document.getElementById('xMaximumMarks').value);
                   if (o != null && m != null) {
                      if (o > m) {
                         document.getElementById('xPercentage').value = 0;
                      }
                      else {
                         document.getElementById('xPercentage').value = (o / m)*100;
                         if (document.getElementById('xPercentage').value >100) {
                            document.getElementById('xPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xObtainedMarks">Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" min="0" max="999" maxlength="3" class="form-control" id="xObtainedMarks" name="xObtainedMarks" value="{{$user1[0]->x_obtained_marks}}" required placeholder="Obtained Marks" onblur="xpercent()">
                 
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xMaximumMarks">Maximum Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xMaximumMarks" name="xMaximumMarks" min="0" max="999" maxlength="3" value="{{$user1[0]->x_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" required placeholder="Maximum Marks" onblur="xpercent()">
                
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xPercentage" name="xPercentage" value="{{$user1[0]->x_percentage}}" placeholder="Percentage" readonly="readonly" "mamragi required>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="form-group  col-md-12" style="font-size: 18px;">
          <label>Is Diploma or HSC</label> &nbsp;&nbsp;&nbsp;
          @foreach($diplomaOrHsc as $key=>$dipxii)
          @if( $user1[0]->is_diploma == $key )
          <input type="radio" id="{{$key}}" name="diplomaHsc" value="{{$key}}" onchange="yesnoCheck('{{$key}}')" checked>&nbsp;{{$dipxii}}&nbsp;
          @endif
          @if( $user1[0]->is_diploma != $key )
          <input type="radio" id="{{$key}}" name="diplomaHsc" value="{{$key}}" onchange="yesnoCheck('{{$key}}')">&nbsp;{{$dipxii}}&nbsp;
          @endif
          @endforeach
          &nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#accademic_diploma_hsc" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label>
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
          <div class="modal fade" id="accademic_diploma_hsc" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Diploma/HSC Instructions</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                  <table class="table table-striped table-bordered" id="academic_diploma_hsc_modal">
                    <thead style="font-weight: bold; text-align: center;">
                      <tr>
                        <td>Field / Section Name</td>
                        <td>Description</td>
                        <td>Example Input</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold;">Diploma Details</td>
                      </tr>
                      <tr>
                        <td>Diploma</td>
                        <td>Select Diploma if this is the latest exam you have cleared before degree.</td>
                        <td>Select Diploma</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold;">HSC Details</td>
                      </tr>
                      <tr>
                        <td>HSC</td>
                        <td>Select HSC if this is the latest exam you have cleared before degree.</td>
                        <td>Select HSC</td>
                      </tr>
                      <tr>
                        <td>Obtained Marks in Maths</td>
                        <td>Enter marks for mathematics subject if you had math in 12th </td>
                        <td>80</td>
                      </tr>
                      <tr>
                        <td>Maximum Marks ( Out of )</td>
                        <td>Enter total marks for math paper</td>
                        <td>100</td>
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
          <!---------------------------------Modal Close------------------------------------------>
          <script type="text/javascript">
            function yesnoCheck(key) {
                if ( key == "D") {
                    document.getElementById('diplomaDetails').style.display = 'block';
                    document.getElementById('hscDetails').disabled = true;
                    document.getElementById('hscDetails').style.display = 'none';
                    // hsc
                    document.getElementById('hscCollegeName').required = false;
                    document.getElementById('hscBoard').required = false;
                    document.getElementById('hscCollegeCity').required = false;
                    document.getElementById('hscCollegeState').required = false;
                    document.getElementById('hscBoard').required = false;
                    document.getElementById('xiiObtainedMarks').required = false;
                    document.getElementById('xiiMaximumMarks').required = false;
                    document.getElementById('xiiPercentage').required = false;
                    // diploma
                    document.getElementById('diplomaCollegeName').required = true;
                    document.getElementById('diplomaBoard').required = true;
                    document.getElementById('diplomaCollegeCity').required = true;
                    document.getElementById('diplomaCollegeState').required = true;
                    document.getElementById('diplomaBranch').required = true;
                    document.getElementById('diplomaObtainedMarks').required = true;
                    document.getElementById('diplomaMaximumMarks').required = true;
                    document.getElementById('diplomaPercentage').required = true;
                }
                if ( key == "H") {
                    document.getElementById('hscDetails').style.display = 'block';
                    document.getElementById('diplomaDetails').disabled = true;
                    document.getElementById('diplomaDetails').style.display = 'none';
                    // hsc
                    document.getElementById('hscCollegeName').required = true;
                    document.getElementById('hscBoard').required = true;
                    document.getElementById('hscCollegeCity').required = true;
                    document.getElementById('hscCollegeState').required = true;
                    document.getElementById('hscBoard').required = true;
                    document.getElementById('xiiObtainedMarks').required = true;
                    document.getElementById('xiiMaximumMarks').required = true;
                    document.getElementById('xiiPercentage').required = true;
                     // diploma
                    document.getElementById('diplomaCollegeName').required = false;
                    document.getElementById('diplomaBoard').required = false;
                    document.getElementById('diplomaCollegeCity').required = false;
                    document.getElementById('diplomaCollegeState').required = false;
                    document.getElementById('diplomaBranch').required = false;
                    document.getElementById('diplomaObtainedMarks').required = false;
                    document.getElementById('diplomaMaximumMarks').required = false;
                    document.getElementById('diplomaPercentage').required = false;
                }
            }
          </script>
        </div>
        <div id="hscDetails" style="display: none;">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">HSC / XII / Equivalent* Details</legend>
            <div class="form-group col-md-6 col-sm-12">
              <label for="hscCollegeName">College Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscCollegeName" name="hscCollegeName" value="{{$user1[0]->xii_college_name}}" placeholder="Enter College Name" required>
             
              <script type="text/javascript">
          document.getElementById("hscCollegeName").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
          }
        </script>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="hscBoard">Board Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscBoard" name="hscBoard" value="{{$user1[0]->xii_board}}" placeholder="Enter Board Name" required>
               <!-- <select class="form-control" id="hscBoard" name="hscBoard" required>    
                @foreach($university_types as $key=>$universityname)          
          @if( $user1[0]->xii_college_name == $key )
          <option value={{$key}} id="selected" selected>{{$universityname}}</option>
          @endif
          @if( $user1[0]->xii_college_name != $key )
          <option value={{$key}}>{{$universityname}}</option>
          @endif
          @endforeach
          
              </select> -->


             
              <script type="text/javascript">
              document.getElementById("hscBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="hscCollegeCity">College City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscCollegeCity" name="hscCollegeCity" value="{{$user1[0]->xii_college_city}}" placeholder="Enter City" required>
              
              <script type="text/javascript">
              document.getElementById("hscCollegeCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="hscCollegeState">College State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="hscCollegeState" name="hscCollegeState" value="{{$user1[0]->xii_college_state}}" placeholder="Enter State" required>
          
              <script type="text/javascript">
              document.getElementById("hscCollegeState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="xiiPassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select class="form-control" id="xiiPassingMonth" name="xiiPassingMonth" required>
                @foreach($months as $key=>$month)
                @if( $user1[0]->xii_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->xii_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="xiiPassingYear">Year of Exam<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
            <select id="xiiPassingYear" name="xiiPassingYear" class="form-control" required>
            </select>
            <script type="text/javascript">
              var dt = new Date();
              var year = 1990;
              var till = dt.getYear() + 1900;
              var options = "";
              var x = {{  $user1[0]->xii_passing_year}};
              for(var y=till; y>=year; y--){
                if(y==x)
                {
                  options += "<option value="+y+" selected>"+ y +"</option>";   
                }
                else  
                {
                  options += "<option value="+y+">"+ y +"</option>";
                }
              }
              document.getElementById("xiiPassingYear").innerHTML = options;
            </script>
            </div>
            <div id="xiipercent">
              <script type="text/javascript">
                function xiipercent() {
                    var o = parseInt(document.getElementById('xiiObtainedMarks').value);
                    var m = parseInt(document.getElementById('xiiMaximumMarks').value);
                   if (o != null && m != null) {
                    if (o > m) {
                      document.getElementById('xiiPercentage').value = 0;
                    }
                    else {
                       var p = (o / m)*100;
                         document.getElementById('xiiPercentage').value=p.toFixed(2);
                      if (document.getElementById('xiiPercentage').value >100) {
                        document.getElementById('xiiPercentage').value = "error";
                      }
                    }
                  }
                }
              </script>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xiiObtainedMarks">Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xiiObtainedMarks" name="xiiObtainedMarks" value="{{$user1[0]->xii_obtained_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Obtained Marks" onblur="xiipercent()" required>
                
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xiiMaximumMarks">Maximum Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xiiMaximumMarks" name="xiiMaximumMarks" value="{{$user1[0]->xii_max_marks}}" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" placeholder="Maximum Marks" onblur="xiipercent()" required>
               
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="xiiPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="xiiPercentage" name="xiiPercentage"  value="{{$user1[0]->xii_percentage}}" placeholder="Percentage" readonly="readonly" maxlength="5" required>
              </div>
            </div>
      </fieldset>
        </div>
        <div id="diplomaDetails">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">Diploma Details</legend>
            <div class="form-group col-md-4 col-sm-12">
              <label for="diplomaCollegeName">College Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="diplomaCollegeName" name="diplomaCollegeName" value="{{$user1[0]->diploma_college_name}}" placeholder="Enter College Name"  required aw>
            
              <script type="text/javascript">
              document.getElementById("diplomaCollegeName").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12 ">
              <label for="diplomaBoard">Board / University Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="diplomaBoard" name="diplomaBoard" value="{{$user1[0]->diploma_university}}" placeholder="Enter Board / University Name">
             
              <script type="text/javascript">
              document.getElementById("diplomaBoard").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="diplomaBranch">Diploma Branch<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="diplomaBranch" name="diplomaBranch" value="{{$user1[0]->diploma_branch}}" placeholder="Diploma Branch">
              
              <script type="text/javascript">
              document.getElementById("diplomaBranch").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
                              }
              </script>  
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="diplomaCollegeCity">College City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="diplomaCollegeCity" name="diplomaCollegeCity" value="{{$user1[0]->diploma_college_city}}" placeholder="Enter City" required>
             
              <script type="text/javascript">
              document.getElementById("diplomaCollegeCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="diplomaCollegeState">College State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="diplomaCollegeState" name="diplomaCollegeState" value="{{$user1[0]->diploma_college_state}}" placeholder="Enter State" required>
              
              <script type="text/javascript">
              document.getElementById("diplomaCollegeState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="diplomaPassingMonth">Month of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select class="form-control" id="diplomaPassingMonth" name="diplomaPassingMonth" required>
                @foreach($months as $key=>$month)
                @if( $user1[0]->diploma_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->diploma_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="diplomaPassingYear">Year of Passing<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="diplomaPassingYear" name="diplomaPassingYear" class="form-control" onchange="checkDate()" required>
              </select>
              <script type="text/javascript">
              function checkDate()
              {
                  var e = document.getElementById("diplomaPassingYear");
                    var value = e.options[e.selectedIndex].value;
                    
              }
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->diploma_passing_year}};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("diplomaPassingYear").innerHTML = options;
              </script>
            </div>
            <div id="dippercent">
              <script type="text/javascript">
                function dipPercent() 
                {
                    var o = parseInt(document.getElementById('diplomaObtainedMarks').value);
                    var m = parseInt(document.getElementById('diplomaMaximumMarks').value);
                   if (o != null && m != null) 
                   {
                      if (o > m) 
                      {
                         document.getElementById('diplomaPercentage').value = 0;
                      }
                      else 
                      {
                        var p = (o / m)*100;
                         document.getElementById('diplomaPercentage').value=p.toFixed(2); 
                         if (document.getElementById('diplomaPercentage').value >100)
                         {
                            document.getElementById('diplomaPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
              <div class="form-group col-md-4 col-sm-12">
                <label for="diplomaObtainedMarks">Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" onblur="dipPercent();" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" id="diplomaObtainedMarks" name="diplomaObtainedMarks" value="{{$user1[0]->diploma_obtained_marks}}" placeholder="Obtained Marks">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="diplomaMaximumMarks">Maximum Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" onblur="dipPercent();" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" id="diplomaMaximumMarks" name="diplomaMaximumMarks" value="{{$user1[0]->diploma_max_marks}}" placeholder="Maximum Marks">
              </div>
              <div class="form-group col-md-4 col-sm-12">
                <label for="diplomaPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="number" class="form-control" id="diplomaPercentage" name="diplomaPercentage"  value="{{$user1[0]->diploma_percentage}}" placeholder="Percentage" readonly="readonly" maxlength="5">
              </div>
            </div>
          </fieldset>
        </div>
        <div id="degreeDetails">
          <fieldset id="fieldset">
            <legend align="top" style="font-weight: bold">Degree Details <font style="font-size: 13px; color: red;">( If you do not have a degree branch name put a " - ")</font></legend>
            <div class="form-group col-md-6 col-sm-12">
              <label for="collegeName">College Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="collegeName" name="degreeCollegeName" value="{{$user1[0]->degree_college_name}}" placeholder="College Name" required>
             
              <script type="text/javascript">
              document.getElementById("collegeName").onkeypress=function(e)
              { 
                var e=window.event || e 
                var keyunicode=e.charCode || e.keyCode 
                return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
              }
              </script>
            </div>
            <div class="form-group col-md-6 col-sm-12">
              <label for="degreeUniversity">Degree University Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="degreeUniversity" name="degreeUniversity" value="{{$user1[0]->degree_university}}"  placeholder="Enter Degree University Name" required>
             
              <script type="text/javascript">
              document.getElementById("degreeUniversity").onkeypress=function(e)
              { 
                var e=window.event || e 
                var keyunicode=e.charCode || e.keyCode 
                return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
              }
              </script>
            </div>
            <div class="form-group col-md-4 col-sm-12">
              <label for="degreeName">Degree Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="degreeName" name="degreeName" value="{{$user1[0]->degree_name}}" placeholder="Degree Name" required>
              
              <script type="text/javascript">
              document.getElementById("degreeName").onkeypress=function(e)
              { 
                var e=window.event || e 
                var keyunicode=e.charCode || e.keyCode 
                return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46 || keyunicode==45)? true : false 
              }
              </script>
            </div>
            
            <div class="form-group col-md-4 col-sm-12">
              <label for="branchName">Degree Branch Name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="branchName" name="branchName" value="{{$user1[0]->degree_branch}}" placeholder="Branch Name"  required>
              
              <script type="text/javascript">

              document.getElementById("branchName").onkeypress=function(e)
              { 
                var e=window.event || e 
                var keyunicode=e.charCode || e.keyCode 
                return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
              }
              </script>
            </div>
            
            <div class="form-group col-md-4 col-sm-12">
              <label for="universityType">University Type<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select class="form-control" id="universityType"  name="universityType" required>
                @foreach($clg_university_types as $key=>$university_type)
                @if( $user1[0]->university_type == $key )
                <option value="{{$key}}" selected>{{$university_type}}</option>
                @endif
                @if( $user1[0]->university_type != $key )
                <option value="{{$key}}">{{$university_type}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <script type="text/javascript">
                                function other() {

                    var k=document.getElementById('universityType');
                 
                    if(k.value=="OMS"){
                      alert(k.value);
                      var temp=document.getElementById('hscotherBoard1');
                      temp.classList.remove("displaynone");
                    }
                    else{
                        var temp=document.getElementById('hscotherBoard1');
                      temp.classList.add("displaynone");
                    }
                  }

            </script>


             <div id="hscotherBoard1" class="form-group col-md-12 col-sm-12">
              <label for="hscState">College Board name<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
               <input type="text" class="form-control" id="degotherBoard" name="degotherBoard" value="{{$user1[0]->university_type}}" required placeholder="Enter Board name" required>
             
              <script type="text/javascript">
              document.getElementById("hscState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            
            <div class="form-group col-md-3 col-sm-12">
              <label for="collegeCity">College City<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="collegeCity" name="collegeCity" value="{{$user1[0]->degree_college_city}}" placeholder="College City" required>
            
              <script type="text/javascript">
              document.getElementById("collegeCity").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="collegeState">College State<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <input type="text" class="form-control" id="collegeState" name="collegeState" value="{{$user1[0]->degree_college_state}}" placeholder="College State" required>
             
              <script type="text/javascript">
              document.getElementById("collegeState").onkeypress=function(e)
                              { 
                              var e=window.event || e 
                              var keyunicode=e.charCode || e.keyCode 
                              return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
                              }
              </script>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="degreePassingMonth">Passing Month<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select class="form-control" id="degreePassingMonth" name="degreePassingMonth" required>
                @foreach($months as $key=>$month)
                @if( $user1[0]->degree_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->degree_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-3 col-sm-12">
              <label for="degreePassingYear">Passing Year<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
              <select id="degreePassingYear" name = degreePassingYear class="form-control" required>
              </select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->degree_passing_year}};
                for(var y=till; y>=year; y--){
                  if(y==x)
                  {
                    options += "<option value="+y+" selected>"+ y +"</option>";   
                  }
                  else  
                  {
                    options += "<option value="+y+">"+ y +"</option>";
                  }
                }
                document.getElementById("degreePassingYear").innerHTML = options;
              </script>
            </div>

            <div class="form-group col-md-12 col-sm-12">
              <br>
              <label style="font-size: 18px;">CGPA System(New) / Percentage System</label>&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#accademic_cgpa_system" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label>
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
              <div class="modal fade" id="accademic_cgpa_system" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">CGPA Instructions</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-striped table-bordered" id="academic_degree_modal">
                        <thead style="font-weight: bold; text-align: center;">
                          <tr>
                            <td>Field / Section Name</td>
                            <td>Description</td>
                            <td>Example Input</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>New</td>
                            <td>Select New if your result is based on CGPA system and you <font style="font-weight: bold;">"HAVE"</font> results for all 8 semesters.</td>
                            <td>Select New</td>
                          </tr>
                          <tr>
                            <td>Old</td>
                            <td>Select New if your result is based on system which does not have cgpa and you have results for all 8 semesters.</td>
                            <td>Select Old</td>
                          </tr>
                          <!-- <tr>
                            <td>Provisional</td>
                            <td>Select New if your result is based on CGPA system and you <font style="font-weight: bold;">"DO NOT HAVE"</font> results for all 8 semesters.</td>
                            <td>Select Provisional</td>
                          </tr> -->
                        <!--   <tr>
                            <td colspan="3" style="font-weight: bold; text-align: center;">Provisional Admission</td>
                          </tr>
                          <tr>
                            <td>Sem 1 SGPA</td>
                            <td>Enter sgpa / gpa of semester 1 in this field</td>
                            <td>8.33</td>
                          </tr>-->
                          <tr>
                            <td>Not Declared</td>
                            <td>Select this checkbox if result is not declared or you cannot submit these details yet. The admission taken in this way will be considered provisional until final CGPA is submitted.</td>
                            <td>Check this box</td>
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
              <!---------------------------------Modal Close------------------------------------------> 
              <br>
              @foreach($newOrOldSystem as $key=>$newOrOld)
              @if( $user1[0]->is_new_or_old == $key )
              <input type="radio" id="{{$key}}" name="newOrOld" value="{{$key}}" onchange="newoldCheck('{{$key}}')" checked>&nbsp;{{$newOrOld}}&nbsp;&nbsp;
              @endif
              @if( $user1[0]->is_new_or_old != $key )
              <input type="radio" id="{{$key}}" name="newOrOld" value="{{$key}}" onchange="newoldCheck('{{$key}}')">&nbsp;{{$newOrOld}}&nbsp;&nbsp;
              @endif
              <script type="text/javascript">
                function newoldCheck(key) {
                    if ( key === "N") {
                        document.getElementById('cgpanew').style.display = 'block';
                        document.getElementById('percentold').disabled = true;
                        document.getElementById('percentold').style.display = 'none';
                        // new
                        document.getElementById('aggrObtainedMarks').required = true;
                        document.getElementById('aggrMaximumMarks').required = true;
                        document.getElementById('aggrPercentage').required = true;
                        document.getElementById('finalCGPA').required = true;
                        // old
                        document.getElementById('degree_1_marks_obt').required = false;
                        document.getElementById('degree_1_marks_max').required = false;
                        document.getElementById('degree_2_marks_obt').required = false;
                        document.getElementById('degree_2_marks_max').required = false;
                        document.getElementById('degree_3_marks_obt').required = false;
                        document.getElementById('degree_3_marks_max').required = false;
                        document.getElementById('degree_4_marks_obt').required = false;
                        document.getElementById('degree_4_marks_max').required = false;
                        document.getElementById('degree_5_marks_obt').required = false;
                        document.getElementById('degree_5_marks_max').required = false;
                        document.getElementById('degree_6_marks_obt').required = false;
                        document.getElementById('degree_6_marks_max').required = false;
                        document.getElementById('degree_7_marks_obt').required = false;
                        document.getElementById('degree_7_marks_max').required = false;
                        document.getElementById('degree_8_marks_obt').required = false;
                        document.getElementById('degree_8_marks_max').required = false;
                    }
                    if ( key === "O") {
                        document.getElementById('percentold').style.display = 'block';
                        document.getElementById('cgpanew').disabled = true;
                        document.getElementById('cgpanew').style.display = 'none';
                        // new
                        document.getElementById('aggrObtainedMarks').required = false;
                        document.getElementById('aggrMaximumMarks').required = false;
                        document.getElementById('aggrPercentage').required = false;
                        document.getElementById('finalCGPA').required = false;
                        // old
                        document.getElementById('degree_1_marks_obt').required = true;
                        document.getElementById('degree_1_marks_max').required = true;
                        document.getElementById('degree_2_marks_obt').required = true;
                        document.getElementById('degree_2_marks_max').required = true;
                        document.getElementById('degree_3_marks_obt').required = true;
                        document.getElementById('degree_3_marks_max').required = true;
                        document.getElementById('degree_4_marks_obt').required = true;
                        document.getElementById('degree_4_marks_max').required = true;
                        document.getElementById('degree_5_marks_obt').required = true;
                        document.getElementById('degree_5_marks_max').required = true;
                        document.getElementById('degree_6_marks_obt').required = true;
                        document.getElementById('degree_6_marks_max').required = true;
                       
                }
              }
              </script>
              @endforeach
            </div>
            <!-----------------------------CGPA NEW------------------------------------------->
            <div id="cgpanew" style="display: block;">
              <div id="degpercent">
                <script type="text/javascript">
                  function degpercent() {
                      var o = parseInt(document.getElementById('aggrObtainedMarks').value);
                      var m = parseInt(document.getElementById('aggrMaximumMarks').value);
                     if (o != null && m != null) {
                        if (o > m) {
                           document.getElementById('aggrPercentage').value = 0;
                        }
                        else {

                        var p = (o / m)*100;
                         document.getElementById('aggrPercentage').value=p.toFixed(2); 
                           if (document.getElementById('aggrPercentage').value >100) {
                              document.getElementById('aggrPercentage').value = "error";
                           }
                        }
                     }
                  }
                </script>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="aggrObtainedMarks">Aggregate Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="5" class="form-control" id="aggrObtainedMarks" name="aggrObtainedMarks" value="{{$user1[0]->degree_aggr_obt_marks}}" placeholder="Aggregate obtained Marks" onblur="degpercent()">
               
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="aggrMaximumMarks">Aggregate Maximum Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="5" class="form-control" id="aggrMaximumMarks" name="aggrMaximumMarks" value="{{$user1[0]->degree_aggr_max_marks}}" placeholder="Aggregate obtained Marks" onblur="degpercent()">
                 
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <label for="aggrPercentage">Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" class="form-control" id="aggrPercentage" name="aggrPercentage" value="{{$user1[0]->degree_percentage }}" placeholder="Percentage"  readonly="readonly">
                </div>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label for="finalCGPA">Final CGPA<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                <input type="text"  maxlength="5" class="form-control" id="finalCGPA" name="finalCGPA" value="{{$user1[0]->degree_final_cgpa }}" placeholder="Final CGPA">

                 <script type="text/javascript">
          document.getElementById("finalCGPA").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32 || keyunicode==46)? true : false 
          }
        </script>
                
              </div>
            </div>
            <!------------------------------------------------------------------------>
            <!----------------------Percentage Old-------------------------------------------------->
            <div id="percentold" style="display: none;">
              <div id="degpercent">
                {{-- Sem 1 --}}
                <div id="sem1">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_1_marks_obt">Sem 1 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_1_marks_obt" name="degree_1_marks_obt" value="{{$user1[0]->degree_sem_1_obt_marks}}" placeholder="Obtained Marks">
                    
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_1_marks_max">Sem 1 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_1_marks_max" name="degree_1_marks_max" value="{{$user1[0]->degree_sem_1_max_marks}}" placeholder="Max Marks">
                   
                  </div>
                </div>
                {{-- Sem 2 --}}
                <div id="sem2">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_2_marks_obt">Sem 2 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_2_marks_obt" name="degree_2_marks_obt" value="{{$user1[0]->degree_sem_2_obt_marks}}" placeholder="Obtained Marks">
                  
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_2_marks_max">Sem 2 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_2_marks_max" name="degree_2_marks_max" value="{{$user1[0]->degree_sem_2_max_marks}}" placeholder="Max Marks">
                    
                  </div>
                </div>
                {{-- Sem 3 --}}
                <div id="sem3">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_3_marks_obt">Sem 3 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_3_marks_obt" name="degree_3_marks_obt" value="{{$user1[0]->degree_sem_3_obt_marks}}" placeholder="Obtained Marks">
                    
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_3_marks_max">Sem 3 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_3_marks_max" name="degree_3_marks_max" value="{{$user1[0]->degree_sem_3_max_marks}}" placeholder="Max Marks">
                   
                  </div>
                </div>
                {{-- Sem 4 --}}
                <div id="sem4">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_4_marks_obt">Sem 4 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_4_marks_obt" name="degree_4_marks_obt" value="{{$user1[0]->degree_sem_4_obt_marks}}" placeholder="Obtained Marks">
                    
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_4_marks_max">Sem 4 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_4_marks_max" name="degree_4_marks_max" value="{{$user1[0]->degree_sem_4_max_marks}}" placeholder="Max Marks">
                   
                  </div>
                </div>
                {{-- Sem 5 --}}
                <div id="sem5">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_5_marks_obt">Sem 5 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_5_marks_obt" name="degree_5_marks_obt" value="{{$user1[0]->degree_sem_5_obt_marks}}" placeholder="Obtained Marks">
                   
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_5_marks_max">Sem 5 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_5_marks_max" name="degree_5_marks_max" value="{{$user1[0]->degree_sem_5_max_marks}}" placeholder="Max Marks">
                   
                  </div>
                </div>
                {{-- Sem 6 --}}
                <div id="sem6">
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_6_marks_obt">Sem 6 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_6_marks_obt" name="degree_6_marks_obt" value="{{$user1[0]->degree_sem_6_obt_marks}}" placeholder="Obtained Marks">
                   
                  </div>
                  <div class="form-group col-md-3 col-sm-12">
                    <label for="degree_6_marks_max">Sem 6 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_6_marks_max" name="degree_6_marks_max" value="{{$user1[0]->degree_sem_6_max_marks}}" onblur="oldagrper()" placeholder="Max Marks">
                    
                  </div>
                </div>
                {{-- Sem 7 --}}
                <div id="sem7">
                  <div class="form-group col-md-6 col-sm-12">
                    <label for="degree_7_marks_obt">Sem 7 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_7_marks_obt" name="degree_7_marks_obt" value="{{$user1[0]->degree_sem_7_obt_marks}}" placeholder="Obtained Marks">
                   
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label for="degree_7_marks_max">Sem 7 Max Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_7_marks_max" name="degree_7_marks_max" value="{{$user1[0]->degree_sem_7_max_marks}}" onblur="oldagrper()" placeholder="Max Marks">
                    
                  </div>
                </div>

                {{-- Sem 8 --}}

                <div id="sem8">
                  <div class="form-group col-md-4 col-sm-12">
                    <label for="degree_8_marks_obt">Sem 8 Obtained Marks<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_8_marks_obt" name="degree_8_marks_obt" value="{{$user1[0]->degree_sem_8_obt_marks}}" placeholder="Obtained Marks">
                   
                  </div>

                  <div class="form-group col-md-4 col-sm-12">
                    <label for="degree_8_marks_max">Sem 8 Max Marks<label style="color: red; font-size:
                     25px;vertical-align: sub;">*</label></label>
                    <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="degree_8_marks_max" name="degree_8_marks_max" value="{{$user1[0]->degree_sem_8_max_marks}}" onblur="oldagrper()" placeholder="Max Marks">
                    
                  </div>
                 
                  <div  class="form-group col-md-4 col-sm-12 adjustmentdiv">
                  <label  for="nd1">Not Declared: </label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                 @if($notDeclared1 == "true" )
                  <input type="checkbox" id="nd1" name="nd1" value="Nd1" onload="notDeclared()" onclick="notDeclared()" checked="true">Not Declared
                 @else
                  <input type="checkbox" id="nd1" name="nd1" value="Nd1" onload="notDeclared()" onclick="notDeclared()" >Not Declared
                  @endif
                  <br><br>  
                </div>
              </div>


                <script type="text/javascript">

                  function notDeclared() {
                    
                  if (document.getElementById('nd1').checked == true) {

                    document.getElementById('degree_8_marks_obt').disabled = true;
                    document.getElementById('degree_8_marks_obt').value = 0;
                    document.getElementById('degree_8_marks_obt').required = false;
                    document.getElementById('degree_8_marks_max').disabled = true;
                    document.getElementById('degree_8_marks_max').value = 0;
                    document.getElementById('degree_8_marks_max').required = false;
                  oldagrper();
                  }
                  else
                  {
                    document.getElementById('degree_8_marks_obt').disabled = false;
                    document.getElementById('degree_8_marks_max').disabled = false;
                    document.getElementById('degree_8_marks_obt').required = true;
                    document.getElementById('degree_8_marks_max').required = true;

                    document.getElementById('nd1').checked == false;
                    oldagrper();
                  }
                }

                  function oldagrper() {
                      
                   var s1o = parseInt(document.getElementById('degree_1_marks_obt').value);
                   var s1m = parseInt(document.getElementById('degree_1_marks_max').value);
                   var s2o = parseInt(document.getElementById('degree_2_marks_obt').value);
                   var s2m = parseInt(document.getElementById('degree_2_marks_max').value);
                   var s3o = parseInt(document.getElementById('degree_3_marks_obt').value);
                   var s3m = parseInt(document.getElementById('degree_3_marks_max').value);
                   var s4o = parseInt(document.getElementById('degree_4_marks_obt').value);
                   var s4m = parseInt(document.getElementById('degree_4_marks_max').value);
                   var s5o = parseInt(document.getElementById('degree_5_marks_obt').value);
                   var s5m = parseInt(document.getElementById('degree_5_marks_max').value);
                   var s6o = parseInt(document.getElementById('degree_6_marks_obt').value);
                   var s6m = parseInt(document.getElementById('degree_6_marks_max').value);
                   var s7o = parseInt(document.getElementById('degree_7_marks_obt').value);
                   var s7m = parseInt(document.getElementById('degree_7_marks_max').value);
                   var s8o = parseInt(document.getElementById('degree_8_marks_obt').value);
                   var s8m = parseInt(document.getElementById('degree_8_marks_max').value);
                   var aggrO = s1o + s2o + s3o + s4o + s5o + s6o + s7o + s8o;
                   document.getElementById('oldAggrObtainedMarks').value = aggrO;
                   var aggrM = s1m + s2m + s3m + s4m + s5m + s6m + s7m + s8m;
                   document.getElementById('oldAggrMaximumMarks').value = aggrM;
                   if (aggrO != null && aggrM != null) {
                      if (aggrO > aggrM) {
                         document.getElementById('oldAggrPercentage').value = 0;
                      }
                      else {
                        var p = (aggrO / aggrM)*100;
                         document.getElementById('oldAggrPercentage').value=p.toFixed(2);                         
                         if (document.getElementById('oldAggrPercentage').value >100) {
                            document.getElementById('oldAggrPercentage').value = "error";
                         }
                      }
                   }
                }
                </script>

                <div class="form-group col-md-4 col-sm-12 ">
                  <label for="oldAggrObtainedMarks">Aggregate Obtained<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="oldAggrObtainedMarks" name="oldAggrObtainedMarks" value="{{$user1[0]->degree_aggr_obt_marks}}" placeholder="Aggregate Obtained" readonly="readonly">
                </div>
                <div class="form-group col-md-4 col-sm-12">
                  <label for="oldAggrMaximumMarks">Aggregate Maximum<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" maxlength="3" class="form-control" id="oldAggrMaximumMarks" name="oldAggrMaximumMarks" value="{{$user1[0]->degree_aggr_max_marks}}" placeholder="Aggregate Maximum" readonly="readonly">
                </div>
                <div class="form-group col-md-4 col-sm-12">
                  <label for="oldAggrPercentage">Final Percentage<label style="color: #eee; font-size: 25px;vertical-align: sub;">*</label></label>
                  <input type="number" class="form-control" id="oldAggrPercentage" name="oldAggrPercentage" value="{{$user1[0]->degree_percentage }}" placeholder="Percentage"  readonly="readonly">
                </div>
              </div>
            </div>
            <!------------------------------------------------------------------------>
            <!-------------------------Provisional----------------------------------------------->
          
          </fieldset>
        </div>
        <div class="form-group btnpadding col-md-6 col-sm-12">
          <a href="{{ route('me_dte_details') }} ">
          <button type="button" class="btn  btn-primary btn-view pull-left" id="back" name="back" style="width: 100%" >Back to Profile</button>
          </a>
        </div>
        <div class="form-group btnpadding col-md-6 col-sm-12">
          <button type="submit" class="btn btn-view btn-primary pull-left" id="submits" name="submits" style="width: 100%" >Save and Continue</button>
        </div>
      </form>
    </div>
  </div>
</body>
<br><br><br>
<style type="text/css">
  @media (min-width: 988px) {
  .adjustmentdiv{
    padding-top: 34px;
  }
}
</style>
@endsection