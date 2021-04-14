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
<body onload="load('{{--{{$user1[0]->category}} --}}  ') ">
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
         var opnct= document.getElementById("opencategory");
            var resct= document.getElementById("reservedcategory");
            var minoct= document.getElementById("minocategory");
            opnct.classList.add("displaynone");
            minoct.classList.add("displaynone");
            resct.classList.add("displaynone");   
  }
</script>
<div class="container">
  <div class="col-md-2">
    <div class="col">
      <div class="row-md-2">
        <br><br>
      </div>
      <!-- <div class="row-md-8">
        <aside>
          <div class="list-group">
            <a href="{{ route('dse_dte_details') }}" class="list-group-item active">
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
            <a href="{{ route('dse_final_submit') }}" class="list-group-item">
              <h5 class="list-group-item-heading">Final Submission</h5>
            </a>
          </div>
        </aside>
      </div> -->
      <div class="row-md-2"></div>
    </div>
  </div>
  <div class="col-md-12">
   
    <h1>DTE Details&nbsp;&nbsp;&nbsp;<label class="btn btn-sm btn-danger" data-toggle="modal" data-target="#dteModal"  onclick="myFunction()" id="myBtn" style="font-weight: bold; border-radius: 100px">?</label></h1>
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
              <h4 class="modal-title" style="text-align: center">DTE Details</h4>
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
                       <td>MH State DTE Merit No.</td>
                       <td>Enter the State DTE Merit No. given on your result</td>
                      <td>67</td>
                    </tr>
                    <tr>
                      <td>Category</td>
                      <td>Enter your category</td>
                      <td>Open</td>
                    </tr>
                    <tr>
                      <td>Candidate Type</td>
                      <td>Enter your candidate type according to the classifications provided by DTE</td>
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
    <form method="post" action="{{route('dse_dte_details')}}"> 
      {{ csrf_field() }}
      <div class="form-group col-md-12">
            <center><h4 style="font-weight: bold; ">Do not use ' (apostrophe) inside any fields</h4></center>
        </div>
      <div class="form-group col-md-12">
        <label for="dteId">DTE ID</label>
        <input type="text" class="form-control" id="dteId" name="dteId" value= "{{$user1[0]->dte_id}}"  placeholder=" DTE ID" disabled>
      </div>
      <div class="form-group col-sm-12 col-md-6">
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
     
      <div class="form-group col-sm-12 col-md-6">
        <label for="candidate_types">Candidature Type<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <select class="form-control" id="candidate_types" name="candidate_types" required>
            {{$user1[0]->candidate_type}}
            @foreach($candidate_types as $key=>$candidate_types)  
           @if( $user1[0]->candidate_type  == $key ) 
          <option value= "{{$key}}"  selected> {{$candidate_types}} </option>
           @endif 
           @if( $user1[0]->candidate_type  != $key ) 
          <option value= "{{$key}}" > {{$candidate_types}} </option>
           @endif  
           @endforeach 
        </select>
      </div>
       
       <div>
       <div class="form-group col-md-12">
        <label for="mhStateGeneralmeritNo">MH State DTE merit No.<label style="color: red; font-size: 25px;vertical-align: sub;">*</label></label>
        <input type="text" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" class="form-control" id="mhStateGeneralmeritNo" name="mhStateGeneralmeritNo" value= "{{$user1[0]->mh_state_general_merit_no}}"   placeholder="Enter merit no." required>
      </div>
      
       @if(session('log_acap') == null)
      <div class="form-group  col-md-6 col-sm-12">
        <label for="seatType">Seat Type</label>
        <input type="text" class="form-control" id="seatType" name="seatType" value= "{{$user1[0]->seat_type}}" placeholder="Seat Type" disabled>
      </div>
        <div class="form-group col-md-6  col-sm-12 ">
        <label for="capRound">Allotted Cap Round</label>
        <input type="text" class="form-control" id="capRound" name="capRound" value=  "{{$user1[0]->allotted_cap_round}}"    placeholder="Allotted Cap Round" disabled>
      </div>
      <div class="form-group col-md-6  col-sm-12 ">
        <label for="courseAllotted">Course Allotted</label>
        <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value= "{{$user1[0]->course_allotted}}"   placeholder="Course Allotted" disabled>
      </div>
      <div class="form-group col-md-6  col-sm-12 ">
        <label for="shift">Shift Allotted</label>
        <input type="text" class="form-control" id="shift" name="shift" value= "{{$user1[0]->shift_allotted}}"    placeholder="Shift" disabled>
      </div> 
      <div class="form-group col-md-6  col-sm-12 ">
        <label for="courseCode">Course Code</label>
        <input type="text" class="form-control" id="courseCode" name="courseCode" value= "{{$user1[0]->course_allotted_code}}"    placeholder="Course Code" disabled>
      </div>
      <div class="form-group col-md-6  col-sm-12 ">
        <label for="choiceCode">DTE Branch</label>
        <input type="text" class="form-control" id="dteBranch" name="dteBranch" value= "{{$user1[0]->dte_branch}}" placeholder="Dte branch" disabled>
      </div>
       @endif 
          
      <div class="form-group col-md-6 btnpadding col-sm-12 ">
        <a href="{{ route('dse_profile') }}">
        <button type="button" class="btn btn-view btn-primary pull-left" id="back" name="back" style="width: 100%" >Back to Profile</button>
        </a>
      </div>
      <br>
      <div class="form-group col-md-6 btnpadding col-sm-12 ">
        <button type="submit" class="btn btn-view  btn-primary pull-left" id="submit" name="submit" style="width: 100%" >Save and Continue</button>
      </div>
      

    
  </div>
</div>
</form>

</div>
</div>
<br>
</body>
@endsection