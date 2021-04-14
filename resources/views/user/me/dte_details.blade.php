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
<body onload="load('{{$sponsored_org}}')">
     <!-- <header style="position: fixed;right: 1px; top: 80px; width: 100% !important;z-index: 1;">

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
                    <li class="active"><a href="{{ route('me_dte_details') }} " ><i class="fa fa-fw fa-home";></i>&nbspDTE Details&nbsp</a></li>
                </div>
              </div>
              
              <div class="col-md" >
                <div class="abc">
                    <li ><a href="{{ route('me_academic_details') }}" ><i class="fa fa-fw fa-home";></i>&nbspAcademic Details&nbsp</a></li>
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
              </ul>
              </nav>
            </header> -->
            <!-- nav bar end -->

  <script type="text/javascript">
     function load(r){
 var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.add("displaynone");
            minoct.classList.add("displaynone");
            resct.classList.add("displaynone");
       

    // Animate loader off screen
    if (r== "true") 
          {
            document.getElementById('checkGate').checked="true";
            document.getElementById('showSponsorship').style.display="block";
            document.getElementById('showGate').style.display="none";
            document.getElementById('gateScore').value="";
            document.getElementById('gateOutOf').value="";
            document.getElementById('gate_reg_no').value="";
            document.getElementById('gate_exam_paper').value="";
            document.getElementById('gate_month').value="";
            document.getElementById('yearOfExam').value="";
            document.getElementById('gateBranch').value="";


            document.getElementById('dteSponsorship').required=true;

            document.getElementById('gateScore').required=false;
            document.getElementById('gateOutOf').required=false;
            document.getElementById('gate_reg_no').required=false;
            document.getElementById('gate_exam_paper').required=false;
            document.getElementById('gate_month').required=false;
            document.getElementById('yearOfExam').required=false;
            document.getElementById('gateBranch').required=false;          

            
          }
          else
          {
            
            document.getElementById('showSponsorship').style.display="none";
            document.getElementById('showGate').style.display="block";
            document.getElementById('dteSponsorship').value="";


            document.getElementById('dteSponsorship').required=false;

            document.getElementById('gateScore').required=true;
            document.getElementById('gateOutOf').required=true;
            document.getElementById('gate_reg_no').required=true;
            document.getElementById('gate_exam_paper').required=true;
            document.getElementById('gate_month').required=true;
            document.getElementById('yearOfExam').required=true;
            document.getElementById('gateBranch').required=true;          

          }
  }
  </script>
<div class="container" style="margin-top: 10px;">
  <div class="col-md-2">
    <div class="col">
  
  <!--       <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('me_dte_details') }}" class="list-group-item active">
              <h5 class="list-group-item-heading btn-view">DTE Details</h5>
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
            @if(session('log_acap') == "yes")
            <a href="{{ route('me_acap_document_upload') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Document Upload</h5>
            </a>
             @endif
            @if(session('log_acap')!="yes")
            <a href="{{ route('me_document_upload') }}" class="list-group-item">
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
      </div> 
   -->
    </div>
  </div>
  <div class="col-md-12">
       
    <h1>DTE Details&nbsp&nbsp&nbsp<label class="btn btn-sm btn-danger" data-toggle="modal"  onclick="myFunction()" data-target="#dteModal" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
      <script>
function myFunction() {
  var a=document.getElementById("dteModal");
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
    <div class="modal " id="dteModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">DTE Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
            <p style="font-weight: bold;">Instructions</p>
            <table class="table table-striped table-bordered" id="dte_modal">
              <thead style="font-weight: bold; text-align: center;">
                <tr>
                  <td>Field Name</td>
                  <td>Description</td>
                  <td>Example Input</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Sponsered</td>
                  <td>For applicants Sponsored by an organization. Applicant should have a proof of work experience from organization that is sponsoring them.</td>
                  <td>Check the box if applicable</td>
                </tr>
                <tr>
                  <td>Sponsoring Organisation</td>
                  <td>Enter name of the organization that is sponsoring you.</td>
                  <td>VESIT Polytechnic</td>
                </tr>
                <tr>
                  <td>Gate Score</td>
                  <td>Enter GATE Score provided on the marksheet.</td>
                  <td>700</td>
                </tr>
                <tr>
                  <td>Qualifying Marks</td>
                  <td>Enter value corresponding to your category eg: General, OBC(NCL), SC/ST/PwD</td>
                  <td>33.73</td>
                </tr>
                <tr>
                  <td>Registration Number</td>
                  <td>Enter Registration Number provided on the marksheet.</td>
                  <td>700</td>
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
      
    <script type="text/javascript">
      $(window).on('load',function(){
          $('#dteModal').modal('show');
      });
    </script>
    
    
    <!---------------------------------Modal Close------------------------------------------>
    <form method="post" action="{{ route('me_dte_details') }}">
      {{ csrf_field() }}
       @if(session('error'))
          <center><p> {{session('error')}}</p></center>
       @endif   
      <div class="form-group col-md-12 col-sm-12">
        <label for="dteId">DTE ID</label>
        <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}"placeholder="DTE ID" disabled>
      </div>
      <div class="form-group col-md-12 col-sm-12">
        <input type="checkbox" onclick="checkGateSponsorship()" id="checkGate" value="Sponsorship" name="checkGate"> &nbsp;&nbsp;<label>Sponsored</label>
      </div>
      <script type="text/javascript">
        function checkGateSponsorship()
        {
          if (document.getElementById('checkGate').checked == true)
          {
            console.log("true");
            document.getElementById('showSponsorship').style.display="block";
            document.getElementById('showGate').style.display="none";

            document.getElementById('dteSponsorship').required=true;

            document.getElementById('gateScore').required=false;
            document.getElementById('gateOutOf').required=false;
            document.getElementById('gate_reg_no').required=false;
            document.getElementById('gate_exam_paper').required=false;
            document.getElementById('gate_month').required=false;
            document.getElementById('yearOfExam').required=false;
            document.getElementById('gateBranch').required=false;          

          }
          else
          {
            console.log("false");
            document.getElementById('showSponsorship').style.display="none";
            document.getElementById('showGate').style.display="block";

            document.getElementById('dteSponsorship').required=false;

            document.getElementById('gateScore').required=true;
            document.getElementById('gateOutOf').required=true;
            document.getElementById('gate_reg_no').required=true;
            document.getElementById('gate_exam_paper').required=true;
            document.getElementById('gate_month').required=true;
            document.getElementById('yearOfExam').required=true;
            document.getElementById('gateBranch').required=true;          

          }
        }
      </script>
      <div id="showSponsorship" style="display: none;">
        
        <div class="form-group col-md-12 col-sm-12">
          <label for="dteSponsorship">Sponsoring Organisation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<label style="color: red;">Minimum two years of experience is mandatory*</label>)</label>
          <input type="text" class="form-control" id="dteSponsorship" value="{{$user1[0]->sponsoring_company}}" name="dteSponsorship" placeholder="Organisation Name">

          <script type="text/javascript">
          document.getElementById("dteSponsorship").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
          <script type="text/javascript">
            $("#dteSponsorship").on("invalid", function (event) {
                event.target.setCustomValidity('Enter proper details.')
            }).bind('blur', function (event) {
                event.target.setCustomValidity('');                
            });
          </script>  
        </div>
      </div>
      <div id="showGate">
      
        <div class="form-group col-md-12 col-sm-12 ">
          <label for="gateBranch">Gate Branch<label style="color: red; font-size: 22px; vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="gateBranch" name="gateBranch" value="{{$user1[0]->gate_branch}}"placeholder="Enter Gate Branch">  

          <script type="text/javascript">
          document.getElementById("gateBranch").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
        </div>
          <div class="form-group col-md-6 col-sm-12 ">
          <label for="gateScore">Gate Score / Marks<label style="color: red; font-size: 22px; vertical-align: sub;">*</label></label>
          <input type="text" style="background-color:  #FFFFFF;" class="form-control" id="gateScore" name="gateScore" value="{{$user1[0]->gate_score}}"placeholder="Enter Gate Score">
          <script type="text/javascript">
          document.getElementById("gateScore").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32|| keyunicode==46)? true : false 
          }
        </script>
          <script type="text/javascript">
            $("#gateScore").on("invalid", function (event) {
                event.target.setCustomValidity('The proper gate score')
            }).bind('blur', function (event) {
                event.target.setCustomValidity('');                
            });
          </script>  
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <label for="gateOutOf">Qualifying Marks<label style="color: red; font-size: 22px; vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="gateOutOf" name="gateOutOf" value="{{$user1[0]->gate_max_marks}}"placeholder="Enter Qualifying Marks">

           <script type="text/javascript">
          document.getElementById("gateOutOf").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>
          <script type="text/javascript">
            $("#gateOutOf").on("invalid", function (event) {
                event.target.setCustomValidity('The proper out of marks')
            }).bind('blur', function (event) {
                event.target.setCustomValidity('');                
            });
          </script>  
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <label for="gateRegNo">Registration No.<label style="color: red; font-size: 22px; vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="gate_reg_no" name="gate_reg_no" value="{{$user1[0]->gate_reg_no}}" placeholder="Enter Registration Number">  
          <script type="text/javascript">
            $("#gate_reg_no").on("invalid", function (event) {
                event.target.setCustomValidity('Enter Registration Number Properly.')
            }).bind('blur', function (event) {
                event.target.setCustomValidity('');                
            });
          </script>
          <script type="text/javascript">
          document.getElementById("gate_reg_no").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode>=48 && keyunicode<=57 )? true : false 
          }
        </script>  
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <label for="gateExamPaper">Examination Paper<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
          <input type="text" class="form-control" id="gate_exam_paper" name="gate_exam_paper" value="{{$user1[0]->gate_exam_paper}}" placeholder="Enter Examination Paper">
           <script type="text/javascript">
          document.getElementById("gate_exam_paper").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=65 && keyunicode<=90 || keyunicode>=97 && keyunicode<=122 || keyunicode==8 || keyunicode==32 || keyunicode>=48 && keyunicode<=57 )? true : false 
          }
        </script>
          <script type="text/javascript" >
            $("#gate_exam_paper").on("invalid", function (event) {
                event.target.setCustomValidity('Enter Examination Paper Type.')
            }).bind('blur', function (event) {
                event.target.setCustomValidity('');                
            });
          </script>  
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <label for="monthOfExam">Month of Exam<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <select class="form-control" id="gate_month" name="gate_month">
             @foreach($months as $key=>$month)
          @if( $user1[0]->gate_month == $key )
          <option value="{{$key}}" selected>{{$month}}</option>
          @endif
          @if( $user1[0]->gate_month != $key )
          <option value="{{$key}}">{{$month}}</option>
          @endif
          @endforeach
          </select>
        </div>
        <div class="form-group col-md-6 col-sm-12 ">
          <label for="yearOfExam">Year of Exam<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
          <select id="yearOfExam" name="yearOfExam" class="form-control"> </select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->gate_year }} ;
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
                document.getElementById("yearOfExam").innerHTML = options;
              </script>
        </div>
      </div>
       @if($activeacap == "yes")
      
      <div class="form-group col-md-6 col-sm-12 ">
        <label for="candidate_types">Candidate Type<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="candidate_types" name="candidate_types" required>
          @foreach($candidate_types as $key=>$candidate_types)
          @if( $user1[0]->candidate_type == $key )
          <option value="{{$key}}" selected>{{$candidate_types}}</option>
          @endif
          @if( $user1[0]->candidate_type != $key )
          <option value="{{$key}}">{{$candidate_types}}</option>
          @endif 
          @endforeach
        </select>
      </div>
     
    
        @else
        <!-- <div class="form-group col-md-6 col-sm-12 ">
        <label for="category">Category<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="category" name="category" required>
          @foreach($categories as $key=>$category)
          @if( $user1[0]->category == $key )
          <option value="{{$key}}" selected>{{$category}}</option>
          @endif
          @if( $user1[0]->category != $key )
          <option value="{{$key}}">{{$category}}</option>
          @endif
          @endforeach
        </select>

      </div> -->
      <div class="form-group col-md-6 col-sm-12 ">
        <label for="category">Category<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
        <!-- <select class="form-control" id="category" name="category" required>
          @foreach($categories as $key=>$category)
          @if( $user1[0]->category == $key )
          <option value="{{$key}}" selected>{{$category}}</option>
          @endif
          @if( $user1[0]->category != $key )
          <option value="{{$key}}">{{$category}}</option>
          @endif
          @endforeach
        </select> -->
        
        <input type="radio" id="r1"  onclick="reserved()" required value="Reserverd" name="cat_Radio">Reserverd
        <input type="radio" id="r2" onclick="Minority()"  value="Minority" name="cat_Radio">Minority
        <input type="radio" id="r3" onclick="General()"  value="General" name="cat_Radio">General
        <script type="text/javascript">

          function reserved() {
            var rs= document.getElementById("r1");
            var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.add("displaynone");
            minoct.classList.add("displaynone");
            resct.classList.remove("displaynone");
            
          }
          function Minority() {
            var rs= document.getElementById("r2");
            var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.add("displaynone");
            minoct.classList.remove("displaynone");
            resct.classList.add("displaynone");
            
          }
          function General() {
            var rs= document.getElementById("r3");
            var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.remove("displaynone");
            minoct.classList.add("displaynone");
            resct.classList.add("displaynone");
            
          }
        </script>
        <style type="text/css">
          .displaynone{
              display: none;
          }
        </style>
        <div class=""  id="opencategory">
        <select class="form-control "  id="category" name="opencategory" required>
        
@foreach($open as $category)          
          @if( $user1[0]->category == $category )
          <option value={{$category}} id="selected" selected>{{$category}}</option>
          @endif
          @if( $user1[0]->category != $category )
          <option value={{$category}}>{{$category}}</option>
          @endif
          @endforeach
          
        </select>
        </div>

         <div class=""  id="reservedcategory">
        <select class="form-control" id="category" name="reservedcategory" required>        
@foreach($reservedtype as $category)          
          @if( $user1[0]->category == $category )
          <option value={{$category}} id="selected" selected>{{$category}}</option>
          @endif
          @if( $user1[0]->category != $category )
          <option value={{$category}}>{{$category}}</option>
          @endif
          @endforeach
          
        </select>
      </div>
      <div  class="" id="minocategory">
        <select class="form-control" id="category" name="minoritycategory" required>        
@foreach($minotype as $category)          
          @if( $user1[0]->category == $category )
          <option value={{$category}} id="selected" selected>{{$category}}</option>
          @endif
          @if( $user1[0]->category != $category )
          <option value={{$category}}>{{$category}}</option>
          @endif
          @endforeach
          
        </select>
      </div>

      </div>
      <div class="form-group col-md-6 col-sm-12 ">
        <label for="candidate_types">Candidate Type<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="candidate_types" name="candidate_types" required>
          @foreach($candidate_types as $key=>$candidate_types)
          @if( $user1[0]->candidate_type == $key )
          <option value="{{$key}}" selected>{{$candidate_types}}</option>
          @endif
          @if( $user1[0]->candidate_type != $key )
          <option value="{{$key}}">{{$candidate_types}}</option>
          @endif 
          @endforeach
        </select>
      </div>
        @endif
      <div class="form-group col-md-12 col-sm-12">
        <label for="mhStateGeneralMeritNo">MH State DTE General Merit No.<label style="color: red; font-size: 22px;vertical-align: sub;">*</label></label>
        <input type="text" class="form-control" id="mhStateGeneralMeritNo" name="mhStateGeneralMeritNo" value="{{$user1[0]->mh_state_general_merit_no}}" placeholder="Enter MH State general merit no."     required>

         <script type="text/javascript">
          document.getElementById("mhStateGeneralMeritNo").onkeypress=function(e)
          {   
          var e=window.event || e 
          var keyunicode=e.charCode || e.keyCode 
          return (keyunicode>=48 && keyunicode<=57 || keyunicode==8 || keyunicode==32)? true : false 
          }
        </script>

        <script type="text/javascript">
          $("#mhStateGeneralMeritNo").on("invalid", function (event) {
          event.target.setCustomValidity('Enter proper MH State General Merit No.')
          }).bind('blur', function (event) {
          event.target.setCustomValidity('');                
          });
        </script>
      </div>
      
      @if($activedte == "yes")
      <div class="form-group col-md-12 col-sm-12">
        <label for="seatType">Seat Type</label>
        <input type="text" class="form-control" id="seatType" name="seatType" value="{{$user1[0]->seat_type}}"  placeholder="Seat Type" disabled>
      </div>
      <div class="form-group col-md-3 col-sm-12 ">
        <label for="capRound">Cap Round</label>
        <input type="text" class="form-control" id="capRound" name="capRound" value="{{$user1[0]->allotted_cap_round}}"  placeholder="Cap Round" disabled>
      </div>
      <div class="form-group col-md-3 col-sm-12   ">
        <label for="courseAllotted">Course Allotted</label>
        <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->course_allotted}}"  placeholder="Course Allotted" disabled>
      </div>
      <div class="form-group col-md-3 col-sm-12  ">
        <label for="courseCode">Course Code</label>
        <input type="text" class="form-control" id="courseCode" name="courseCode" value="{{$user1[0]->course_allotted_code}}"  placeholder="Course Code" disabled>
      </div>
      <div class="form-group col-md-3 col-sm-12  ">
        <label for="dtebranch">Branch Allotted</label>
        <input type="text" class="form-control" id="dtebranch" name="dtebranch" value="{{$user1[0]->dte_branch}}"  placeholder="Branch Allotted" disabled>
      </div>
      @endif
      <div class="form-group btnpadding col-md-6  col-sm-12  ">
        <a href="{{ route('me_profile') }} ">
        <button type="button" class="btn btn-primary pull-left btn-view" id="back" name="back" style="width: 100%" >Back to Profile</button>
        </a>
      </div>
      <div class="form-group btnpadding col-md-6 col-sm-12  ">
        <button type="submit" class="btn btn-primary pull-left btn-view" id="submit" name="submit" style="width: 100%" >Save and Continue</button>
      </div>
    </form>
  </div>
</div>




</header>
</body>

</body>
@endsection