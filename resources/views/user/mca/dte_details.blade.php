@extends('layout.newapp6')
@section('content')
<noscript>
  <style type="text/css">
    .container {display:none;}
  </style>
</noscript>
<div class="se-pre-con">
    <center><label style="font-size:50px;"><br><br><br><br><br><br>Page Loading...</label></center>
    </div>
<body  onload="dropdownhide()">
  <script type="text/javascript">
      function dropdownhide(){
        
         var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.add("displaynone");
            minoct.classList.add("displaynone");
            resct.classList.add("displaynone");
       }
  </script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
<!--
<script type="text/javascript">
  function load(r)
  {
      wait();
     if(r == 'RESERVED')
      {
      document.getElementById('reserved').disabled=false;
      }
  }
</script>-->
<div class="container">
  <!-- <div class="col-md-2">
    <div class="col">
      <div class="row-md-2">
        <br><br>
      </div> -->
      <!-- <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('mca_dte_details') }}" class="list-group-item active">
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
            <a href="{{ route('mca_document_upload') }}" class="list-group-item">
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
     <!--  <div class="row-md-2"></div>
    </div>
  </div> -->
  <div class="col-md-12">
     


   
 <h1>DTE Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" onclick="myFunction()" data-target="#dteModal" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
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
            <div class="noscriptmsg">
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
                      <td>CET Score</td>
                      <td rowspan="8" style="padding-top: 130px;">Enter these details from your DTE CET result.</td>
                      <td>123</td>
                    </tr>
                    <tr>
                      <td>Month of Exam</td>
                      <td>Apr</td>
                    </tr>
                    <tr>
                      <td>Year of Exam</td>
                      <td>2018</td>
                    </tr>
                    <tr>
                      <td>MH State DTE Merit No.</td>
                      <td>67</td>
                    </tr>
                    <tr>
                      <td>Category</td>
                      <td>Open</td>
                    </tr>
                    <tr>
                      <td>Candidate Type</td>
                      <td>Type B</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @if($user1[0]->is_dte_details_completed==0)
    <script type="text/javascript" >
      $(window).on('load',function(){
          $('#dteModal').modal('show');
      });
    </script>
    @endif
    <!---------------------------------Modal Close------------------------------------------>
    <form method="post" action="{{ route('mca_dte_details') }}">
      {{ csrf_field() }}
      <div class="form-group col-md-12">
            <center><h4 style="font-weight: bold; ">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
      <div class="form-group col-md-12">
        <label for="dteId">DTE ID</label>
        <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}"placeholder=" DTE ID" disabled>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="cetScore">CET Score<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="number" class="form-control" id="cetScore" max="200" min="0" step="0.01" pattern="[0-9]+(\.[0-9]{0,2})?" title="Enter CET score porperly i.e 000.00" name="cetScore" value="{{$user1[0]->cet_score}}" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter CET Score" required>
         
      </div>
       <div class="form-group col-md-6 col-sm-12">
        <label for="cetScore">CET Percentile<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="number" class="form-control" id="cetPercentile" max="100" min="0" step="0.01" pattern="[0-9]+(\.[0-9]{0,2})?" onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)'  name="cetPercentile" value="{{$user1[0]->cet_percentile}}" maxlength="5"  placeholder="Enter CET Percentile" required>
          
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="monthOfExam">Month of Exam<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="cet_month" name="cet_month" required>
          @foreach($months as $key=>$month)
          @if( $user1[0]->cet_month == $key )
          <option value="{{$key}}" selected>{{$month}}</option>
          @endif
          @if( $user1[0]->cet_month != $key )
          <option value="{{$key}}">{{$month}}</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="yearOfExam">Year of Exam<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <select id="yearOfExam" name="yearOfExam" class="form-control" required>
              </select>
              <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x = {{  $user1[0]->cet_year }} ;
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
      <div class="form-group col-md-6 col-sm-12">
        <label for="mhStateGeneralmeritNo">MH State DTE merit No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" class="form-control" id="mhStateGeneralmeritNo" name="mhStateGeneralmeritNo" value="{{$user1[0]->mh_state_general_merit_no}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter merit no." required>
        
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="category">Category<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        

        
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
     
      <div class="form-group col-md-6 col-sm-12">
        <label for="candidate_types">Candidate Type<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="candidate_types" name="candidate_types" required>
            {{$user1[0]->candidate_type}}
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
      @if(session('log_acap') == null)
      <div class="form-group col-md-6 col-sm-12">
        <label for="seatType">Seat Type<label style="font-size: 25px;">&nbsp;</label></label>
        <input type="text" class="form-control" id="seatType" name="seatType" value="{{$user1[0]->seat_type}}"  placeholder="Seat Type" disabled>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="shift">Shift Allotted<label style="font-size: 25px;">&nbsp;</label></label>
        <input type="text" class="form-control" id="shift" name="shift" value="{{$user1[0]->shift_allotted}}"  placeholder="Shift" disabled>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="capRound">Allotted Cap Round<label style="font-size: 25px;">&nbsp;</label></label>
        <input type="text" class="form-control" id="capRound" name="capRound" value="{{$user1[0]->allotted_cap_round}}"  placeholder="Allotted Cap Round" disabled>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="courseAllotted">Course Allotted<label style="font-size: 25px;">&nbsp;</label></label>
        <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->course_allotted}}"  placeholder="Course Allotted" disabled>
      </div>
      <div class="form-group col-md-6 col-sm-12">
        <label for="courseCode">Course Code<label style="font-size: 25px;">&nbsp;</label></label>
        <input type="text" class="form-control" id="courseCode" name="courseCode" value="{{$user1[0]->course_allotted_code}}"  placeholder="Course Code" disabled>
      </div>
     
      @endif
      <div class="form-group btnpadding col-md-6 col-sm-6" style="margin-top:20px !important;">
        <a href="{{ route('mca_profile') }}">
        <button type="button" class="btn btn-view btn-primary pull-left" id="back" name="back" style="width: 100%" >Back to Profile</button>
        </a>
      </div>
      <div class="form-group btnpadding col-md-6 col-sm-6" style="margin-top:20px !important;">
        <button type="submit" class="btn btn-view btn-primary pull-left" id="submit" name="submit" style="width: 100%" >Save and Continue</button>
      </div>

    </form>
  </div>
</div>
<br><br><br>
</body>
@endsection


