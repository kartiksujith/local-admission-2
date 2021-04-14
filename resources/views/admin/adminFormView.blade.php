@extends('layout.adminApp')
@section('content')
<div class="container">
  <div class="col-md-12">
    <h1>Form View</h1>
    <form>
      {{csrf_field()}}
     <br>
      <div class="col-md-12">
        <div class="form-group">
          <style>
            .table-bordered {
            border: 2px solid #000000;
            }
            .table-bordered > thead > tr {
            background-color: #ffc002;
            }
            .table-bordered > thead > tr > th {
            font-weight: bold;
            }
            .table-bordered > tbody > tr > th {
            background-color: #346aa542;
            font-weight: bold;
            }
            .btn{
            width: 100%;
            color: #002147;
            background-color: #ffc002;
            }
          </style>
          {{-- Table Head --}}
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan="2" style="background-color: #ffc002; color: #ffffff;">DTE ID</th>
                <th colspan="3" style="background-color: #f9f9f9">
                  <input type="text" class="form-control" id="dteId" name="dteId" value="{{$user1[0]->dte_id}}"placeholder=" DTE ID" disabled>
                </th>
              </tr>
              <script type="text/javascript">
                function showDTEDetails()
                {  
                  if (document.getElementById('dteDetails').style.display === "none") {
                    document.getElementById('dteDetails').style.display = "inline-table";
                    document.getElementById('academicDetails').style.display = "none";
                    document.getElementById('personalDetails').style.display = "none";
                    document.getElementById('guardianDetails').style.display = "none";
                    document.getElementById('contactDetails').style.display = "none";
                  } 
                  else {
                    document.getElementById('dteDetails').style.display = "none";
                  }
                }
                function showAcademicDetails()
                {  
                  if (document.getElementById('academicDetails').style.display === "none") {
                    document.getElementById('academicDetails').style.display = "inline-table";
                    document.getElementById('dteDetails').style.display = "none";
                    document.getElementById('personalDetails').style.display = "none";
                    document.getElementById('guardianDetails').style.display = "none";
                    document.getElementById('contactDetails').style.display = "none";
                  } 
                  else {
                    document.getElementById('academicDetails').style.display = "none";
                  }
                }
                function showPersonalDetails()
                {  
                  if (document.getElementById('personalDetails').style.display === "none") {
                    document.getElementById('personalDetails').style.display = "inline-table";
                    document.getElementById('dteDetails').style.display = "none";
                    document.getElementById('academicDetails').style.display = "none";
                    document.getElementById('guardianDetails').style.display = "none";
                    document.getElementById('contactDetails').style.display = "none";
                  } 
                  else {
                    document.getElementById('personalDetails').style.display = "none";
                  }
                }
                function showGuardianDetails()
                {  
                  if (document.getElementById('guardianDetails').style.display === "none") {
                    document.getElementById('guardianDetails').style.display = "inline-table";
                    document.getElementById('dteDetails').style.display = "none";
                    document.getElementById('academicDetails').style.display = "none";
                    document.getElementById('personalDetails').style.display = "none";
                    document.getElementById('contactDetails').style.display = "none";
                  } 
                  else {
                    document.getElementById('guardianDetails').style.display = "none";
                  }
                }
                function showContactDetails()
                {  
                  if (document.getElementById('contactDetails').style.display === "none") {
                    document.getElementById('contactDetails').style.display = "inline-table";
                    document.getElementById('dteDetails').style.display = "none";
                    document.getElementById('academicDetails').style.display = "none";
                    document.getElementById('personalDetails').style.display = "none";
                    document.getElementById('guardianDetails').style.display = "none";
                  } 
                  else {
                    document.getElementById('contactDetails').style.display = "none";
                  }
                }
              </script>
              <tr>
                <th style="background-color: #002147;">
                  <button type="button" class="btn" onclick="showDTEDetails()" style="background-color: #002147; color: #ffffff;">Dte Details</button>
                </th>
                <th style="background-color: #002147;">
                  <button type="button" class="btn" onclick="showAcademicDetails()" style="background-color: #002147; color: #ffffff;">Academic Details</button>
                </th>
                <th style="background-color: #002147;">
                  <button type="button" class="btn" onclick="showPersonalDetails()" style="background-color: #002147; color: #ffffff;">Personal Details</button>
                </th>
                <th style="background-color: #002147;">
                  <button type="button" class="btn" onclick="showGuardianDetails()" style="background-color: #002147; color: #ffffff;">Guardian Details</button>
                </th>
                <th style="background-color: #002147;">
                  <button type="button" class="btn" onclick="showContactDetails()" style="background-color: #002147; color: #ffffff;">Contact Details</button>
                </th>
              </tr>
              <tr>
                <th style="background-color: #002147;" colspan="5">
                  <a href="{{route('backtopage')}}"><button type="button" class="btn btn-sm" id="sieze" style="background-color: #002147; color: #ffffff; width: 100%;">Back</button></a>
                </th>
              </tr>
            </thead>
          </table>
        </div>
      </form>
          {{-- Dte Details --}}
        <form method="post" action="{{ route('update_mca_dte_details') }}">
          {{csrf_field()}}
          <table  id="dteDetails" class="table table-bordered table-striped" style="display: none;">
            <tbody>
              <tr>
                <th>CET Score</th>
                <td>
                  <input type="text" class="form-control" id="cetScore" name="cetScore" value="{{$user1[0]->cet_score}}"placeholder="Enter CET Score">
                </td>
                <th>CET Percentile</th>
                <td>
                  <input type="text" class="form-control" id="cetPercentile" name="cetPercentile" value="{{$user1[0]->cet_percentile}}" maxlength="3" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" placeholder="Enter CET Score">
                </td>
              </tr>
              <tr>
                <th>Month Of Exam</th>
                <td>
                  <select class="form-control" id="cet_month" name="cet_month">
                    @foreach($months as $key=>$month)
                    @if( $user1[0]->cet_month == $key )
                    <option value="{{$key}}" selected>{{$month}}</option>
                    @endif
                    @if( $user1[0]->cet_month != $key )
                    <option value="{{$key}}">{{$month}}</option>
                    @endif
                    @endforeach 
                    <option value="Apr">Apr</option>
                    <option value="May" selected>May</option>
                  </select>
                </td>
                <th>Year Of Exam</th>
                <td>
                  <input type="text" class="form-control" id="yearOfExam" name="yearOfExam" value="{{$user1[0]->cet_year}}"placeholder="Enter Year Of Exam">
                </td>
              </tr>
              <tr>
                <th>MH State DTE merit No.</th>
                <td>
                  <input type="text" class="form-control" id="mhStateGeneralmeritNo" name="mhStateGeneralmeritNo" value="{{$user1[0]->mh_state_general_merit_no}}" placeholder="Enter MH State merit no.">
                </td>
                 <th>Category</th>
                <td>
                  <select class="form-control" id="category" name="category">
                     @foreach($categories as $key=>$category)
                    @if( $user1[0]->category == $key )
                    <option value="{{$key}}" selected>{{$category}}</option>
                    @endif
                    @if( $user1[0]->category != $key )
                    <option value="{{$key}}">{{$category}}</option>
                    @endif
                    @endforeach 
                    <option value="Open">Open</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Candidate Type</th>
                <td>
                  <select class="form-control" id="candidate_types" name="candidate_types">
                     @foreach($candidate_types as $key=>$candidate_types)
                    @if( $user1[0]->candidate_type == $key )
                    <option value="{{$key}}" selected>{{$candidate_types}}</option>
                    @endif
                    @if( $user1[0]->candidate_type != $key )
                    <option value="{{$key}}">{{$candidate_types}}</option>
                    @endif 
                    @endforeach 
                    <option value="Type A">Type A</option>
                  </select>
                </td>
                
              </tr>
              <tr>
                <th>Allotted Cap Round</th>
                <td>
                  <input type="text" class="form-control" id="capRound" name="capRound" value="{{$user1[0]->allotted_cap_round}}"  placeholder="Allotted Cap Round" disabled>
                </td>
                <th>Seat Type</th>
                <td>
                  <input type="text" class="form-control" id="seatType" name="seatType" value="{{$user1[0]->seat_type}}"  placeholder="Seat Type">
                </td>
              </tr>
              <tr>
                <th>Course Allotted</th>
                <td>
                  <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->course_allotted}}"  placeholder="Course Allotted" disabled>
                </td>
                <th>Course Code</th>
                <td>
                  <input type="text" class="form-control" id="courseCode" name="courseCode" value="{{$user1[0]->course_allotted_code}}"  placeholder="Course Code" disabled>
                </td>
              </tr>
              <tr>
                <th>Course Allotted</th>
                <td>
                  <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->shift_allotted}}"  placeholder="shift Allotted" disabled>
                </td>
              </tr>
              
              <tr style="text-align: center; background-color: #002147;">
                <td colspan="4">
      
                    <button type="submit" class="btn btn" id="updateDTEDetails" style="background-color: #002147; color: #ffffff">Update DTE Details</button>
              
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          {{-- Academic Details --}}
        <form method="post" action="{{ route('update_mca_academic_details') }}">
          {{csrf_field()}}
          <table class="table table-bordered table-striped" id="academicDetails" style="display: none">
            <tbody>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">10TH Details</th>
              </tr>
              <tr>
                <th>SSC School Name</th>
                <td>
                  <input type="text" class="form-control" id="sscSchoolName" name="sscSchoolName" value="{{$user1[0]->x_school_name}}" placeholder="Enter SSC School name">
                </td>
                <th>SSC Board Name</th>
                <td>
                  <input type="text" class="form-control" id="sscBoard" name="sscBoard" value="{{$user1[0]->x_board}}" placeholder="Enter SSC Board name">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="sscSchoolCity" name="sscSchoolCity" value="{{$user1[0]->x_school_city}}" placeholder="Enter City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="sscSchoolState" name="sscSchoolState" value="{{$user1[0]->x_school_state}}" placeholder="Enter State">
                </td>
              </tr>
              <th>Month of Passing</th>
                <td>                  
                  <select id="xPassingMonth" name="xPassingMonth" class="form-control" required>
               @foreach($months as $key=>$month)
                @if( $user1[0]->x_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->x_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                <th>Year of Passing</th>
                <td>
                  <select id="xPassingYear" name="xPassingYear" class="form-control" required>
              </select>
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->x_passing_year}};
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
                </td>
              </tr>
              
              <script type="text/javascript">
                function xpercent() {
                   if (document.getElementById('xObtainedMarks').value != null && document.getElementById('xMaximumMarks').value != null) {
                      if (document.getElementById('xObtainedMarks').value > document.getElementById('xMaximumMarks').value) {
                         document.getElementById('xPercentage').value = 0;
                      }
                      else {
                         document.getElementById('xPercentage').value = (document.getElementById('xObtainedMarks').value / document.getElementById('xMaximumMarks').value)*100;
                         if (document.getElementById('xPercentage').value >100) {
                            document.getElementById('xPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
              <tr>
                <th>Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="xObtainedMarks" name="xObtainedMarks" value="{{$user1[0]->x_obtained_marks}}" placeholder="Obtained Marks" onblur="xpercent()">
                </td>
                <th>Maximum Marks</th>
                <td>
                  <input type="text" class="form-control" id="xMaximumMarks" name="xMaximumMarks" value="{{$user1[0]->x_max_marks}}" placeholder="Maximum Marks" onblur="xpercent()">
                </td>
              </tr>
              <tr>
                <th>Percentage</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="xPercentage" name="xPercentage" value="{{$user1[0]->x_percentage}}" placeholder="Percentage" readonly="readonly">
                </td>
              </tr>
              <tr>
                <th colspan="2">Diploma / HSC</th>
                <td>
                  <button type="button" class="btn" onclick="clearHSC()" style="background-color: #002147; color: #ffffff;">Clear HSC</button>
                </td>
                <td>
                  <button type="button" class="btn" onclick="clearDiploma()" style="background-color: #002147; color: #ffffff;">Clear Diploma</button>
                </td>
                <script type="text/javascript">
                  function  clearHSC() {
                    document.getElementById('hscCollegeName').value = '';
                    document.getElementById('hscBoard').value = '';
                    document.getElementById('hscCollegeCity').value = '';
                    document.getElementById('hscCollegeState').value = '';
                    document.getElementById('xiipassingMonth').value = '';
                    document.getElementById('xiipassingYear').value = '';
                    document.getElementById('xiiObtainedMarks').value = '';
                    document.getElementById('xiiMaximumMarks').value = '';
                    document.getElementById('xiiPercentage').value = '';
                    document.getElementById('xiiMathObtainedMarks').value = '';
                    document.getElementById('xiiMathMaxMarks').value = '';
                  }
                  function  clearDiploma() {
                    document.getElementById('diplomaCollegeName').value = '';
                    document.getElementById('diplomaBoard').value = '';
                    document.getElementById('diplomaBranch').value = '';
                    document.getElementById('diplomaCollegeCity').value = '';
                    document.getElementById('diplomaCollegeState').value = '';
                    document.getElementById('diplomaPassingMonth').value = '';
                    document.getElementById('diplomaPassingYear').value = '';
                    document.getElementById('diplomaObtainedMarks').value = '';
                    document.getElementById('diplomaMaximumMarks').value = '';
                    document.getElementById('diplomaPercentage').value = '';
                  }
                </script>
              </tr>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">12TH Details</th>
              </tr>
              <tr>
                <th>HSC College Name</th>
                <td>
                  <input type="text" class="form-control" id="hscCollegeName" name="hscCollegeName" value="{{$user1[0]->xii_college_name}}" placeholder="Enter College Name">
                </td>
                <th>Board Name</th>
                <td>
                  <input type="text" class="form-control" id="hscBoard" name="hscBoard" value="{{$user1[0]->xii_board}}" placeholder="Enter Board Name">                  
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="hscCollegeCity" name="hscCollegeCity" value="{{$user1[0]->xii_college_city}}" placeholder="Enter City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="hscCollegeState" name="hscCollegeState" value="{{$user1[0]->xii_college_state}}" placeholder="Enter State">
                </td>
              </tr>
              <tr>

                <th>Month of Passing</th>
                <td>                  
                  <select id="xiipassingMonth" name="xiipassingMonth" class="form-control" required>
               @foreach($months as $key=>$month)
                @if( $user1[0]->xii_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->xii_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                <th>Year of Passing</th>
                <td>
                  <select id="xiipassingYear" name="xiipassingYear" class="form-control" required>
              </select>
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->xii_passing_year}};
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
                document.getElementById("xiipassingYear").innerHTML = options;
              </script>
                </td>
              </tr>
               
              <script type="text/javascript">
                function xiipercent() {
                  if (document.getElementById('xiiObtainedMarks').value != null && document.getElementById('xiiMaximumMarks').value != null) {
                    if (document.getElementById('xiiObtainedMarks').value > document.getElementById('xiiMaximumMarks').value) {
                      document.getElementById('xiiPercentage').value = 0;
                    }
                    else {
                      document.getElementById('xiiPercentage').value = (document.getElementById('xiiObtainedMarks').value / document.getElementById('xiiMaximumMarks').value)*100;
                      if (document.getElementById('xiiPercentage').value >100) {
                        document.getElementById('xiiPercentage').value = "error";
                      }
                    }
                  }
                }
              </script>
              <tr>
                <th>Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="xiiObtainedMarks" name="xiiObtainedMarks" value="{{$user1[0]->xii_obtained_marks}}" placeholder="Obtained Marks" onblur="xiipercent()">
                </td>
                <th>Maximum Marks</th>
                <td>
                  <input type="text" class="form-control" id="xiiMaximumMarks" name="xiiMaximumMarks" value="{{$user1[0]->xii_max_marks}}" placeholder="Maximum Marks" onblur="xiipercent()">
                </td>
              </tr>
              <tr>
                <th>Percentage</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="xiiPercentage" name="xiiPercentage"  value="{{$user1[0]->xii_percentage}}" placeholder="Percentage" readonly="readonly">
                </td>
              </tr>
              <tr>
                <th>Obtained Marks in Maths</th>
                <td>
                  <input type="text" class="form-control" id="xiiMathObtainedMarks" name="xiiMathObtainedMarks" value="{{$user1[0]->xii_maths_obtained_marks}}" placeholder="Enter Marks">
                </td>
                <th>Maximum Marks( Out Of )</th>
                <td>
                  <input type="text" class="form-control" id="xiiMathMaxMarks" name="xiiMathMaxMarks" value="{{$user1[0]->xii_maths_max_marks}}" placeholder="Enter Marks">
                </td>
              </tr>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">Diploma Details</th>
              </tr>
              <tr>
                <th>College Name</th>
                <td>
                  <input type="text" class="form-control" id="diplomaCollegeName" name="diplomaCollegeName" value="{{$user1[0]->diploma_college_name}}" placeholder="Enter College Name">
                </td>
                <th>Board / University Name</th>
                <td>
                  <input type="text" class="form-control" id="diplomaBoard" name="diplomaBoard" value="{{$user1[0]->diploma_university}}" placeholder="Enter Board Name">
                </td>
              </tr>
              <tr>
                <th>Diploma Branch</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="diplomaBranch" name="diplomaBranch" value="{{$user1[0]->diploma_branch}}"  placeholder="Diploma Branch">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="diplomaCollegeCity" name="diplomaCollegeCity" value="{{$user1[0]->diploma_college_city}}" placeholder="Enter City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="diplomaCollegeState" name="diplomaCollegeState" value="{{$user1[0]->diploma_college_state}}" placeholder="Enter State">
                </td>
              </tr>

              <tr>
                <th>Month of Passing</th>
                <td>                  
                  <select id="diplomaPassingMonth" name="diplomaPassingMonth" class="form-control" required>
               @foreach($months as $key=>$month)
                @if( $user1[0]->diploma_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->diploma_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                <th>Year of Passing</th>
                <td>
                  <select id="diplomaPassingYear" name="diplomaPassingYear" class="form-control">
              </select>
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->diploma_passing_year}};
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
                </td>
              </tr>
              <script type="text/javascript">
                function dippercent() {
                   if (document.getElementById('diplomaObtainedMarks').value != null && document.getElementById('diplomaMaximumMarks').value != null) {
                      if (document.getElementById('diplomaObtainedMarks').value > document.getElementById('diplomaMaximumMarks').value) {
                         document.getElementById('diplomaPercentage').value = 0;
                      }
                      else {
                         document.getElementById('diplomaPercentage').value = (document.getElementById('diplomaObtainedMarks').value / document.getElementById('diplomaMaximumMarks').value)*100;
                         if (document.getElementById('diplomaPercentage').value >100) {
                            document.getElementById('diplomaPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
              <tr>
                <th>Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="diplomaObtainedMarks" name="diplomaObtainedMarks" value="{{$user1[0]->diploma_obtained_marks}}" placeholder="Obtained Marks" onblur="dippercent()">
                </td>
                <th>Max Marks</th>
                <td>
                  <input type="text" class="form-control" id="diplomaMaximumMarks" name="diplomaMaximumMarks" value="{{$user1[0]->diploma_max_marks}}" placeholder="Maximum Marks" onblur="dippercent()">
                </td>
              </tr>
              <tr>
                <th>Percentage</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="diplomaPercentage" name="diplomaPercentage"  value="{{$user1[0]->diploma_percentage}}" placeholder="Percentage" readonly="readonly">
                </td>
              </tr>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">Degree Details</th>
              </tr>
              <tr>
                <th>College Name</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="collegeName" name="degreeCollegeName" value="{{$user1[0]->degree_college_name}}" placeholder="College Name">
                </td>
              </tr>
                  <tr>
                <th>Degree University Type</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="university_type" name="university_type" value="{{$user1[0]->university_type}}" placeholder="Degree University Type">
                </td>
              </tr>
              <tr>
                <th>University Name</th>
                <td>
                  <input type="text" class="form-control" id="degreeUniversity" name="degreeUniversity" value="{{$user1[0]->degree_university}}"  placeholder="Enter University Name">
                </td>
                <th>Branch</th>
                <td>
                  <input type="text" class="form-control" id="degreeBranch" name="degreeBranch" value="{{$user1[0]->degree_branch}}"  placeholder="Enter Branch">
                </td>
              </tr>
              <tr>
                <th>Maths( Obtained Marks )</th>
                <td>
                  <input type="text" class="form-control" id="degreeMathObtainedMarks" name="degreeMathObtainedMarks" value="{{$user1[0]->degree_maths_obt_marks}}" placeholder="Enter Marks">
                </td>
                <th>Maths( Maximum Marks )</th>
                <td>
                  <input type="text" class="form-control" id="degreeMathMaxMarks" name="degreeMathMaxMarks" value="{{$user1[0]->degree_maths_max_marks}}" placeholder="Enter Marks">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="collegeCity" name="collegeCity" value="{{$user1[0]->degree_college_city}}" placeholder="College City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="collegeState" name="collegeState" value="{{$user1[0]->degree_college_state}}" placeholder="College State">
                </td>
              </tr>
              
               <tr>
                <th>Month of Passing</th>
                <td>                  
                  <select id="degreePassingMonth" name="degreePassingMonth" class="form-control" required>
               @foreach($months as $key=>$month)
                @if( $user1[0]->degree_passing_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->degree_passing_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                <th>Year of Passing</th>
                <td>
                  <select id="degreePassingYear" name="degreePassingYear" class="form-control" required>
              </select>
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->degree_passing_year}};
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
                </td>
              </tr>

              
              <tr>
                <th>New / Old / Provisional</th>
                <td>
                  <button type="button" class="btn" onclick="clearNew()" style="background-color: #002147; color: #ffffff;">Clear New</button>
                </td>
                <td>
                  <button type="button" class="btn" onclick="clearOld()" style="background-color: #002147; color: #ffffff;">Clear Old</button>
                </td>
                <td>
                  <button type="button" class="btn" onclick="clearProvisional()" style="background-color: #002147; color: #ffffff;">Clear Provisional</button>
                </td>
                <script type="text/javascript">
                  function  clearNew() {
                    document.getElementById('aggrObtainedMarks').value = '';
                    document.getElementById('aggrMaximumMarks').value = '';
                    document.getElementById('aggrPercentage').value = '';
                    document.getElementById('finalCGPA').value = '';
                  }
                  function  clearOld() {
                    document.getElementById('degree_1_marks_obt').value = '';
                    document.getElementById('degree_1_marks_max').value = '';
                    document.getElementById('degree_2_marks_obt').value = '';
                    document.getElementById('degree_2_marks_max').value = '';
                    document.getElementById('degree_3_marks_obt').value = '';
                    document.getElementById('degree_3_marks_max').value = '';
                    document.getElementById('degree_4_marks_obt').value = '';
                    document.getElementById('degree_4_marks_max').value = '';
                    document.getElementById('degree_5_marks_obt').value = '';
                    document.getElementById('degree_5_marks_max').value = '';
                    document.getElementById('degree_6_marks_obt').value = '';
                    document.getElementById('degree_6_marks_max').value = '';
                    document.getElementById('oldAggrObtainedMarks').value = '';
                    document.getElementById('oldAggrMaximumMarks').value = '';
                    document.getElementById('oldAggrPercentage').value = '';
                  }
                  function  clearProvisional() {
                    document.getElementById('sem1Cgpa').value = '';
                    document.getElementById('sem2Cgpa').value = '';
                    document.getElementById('sem3Cgpa').value = '';
                    document.getElementById('sem4Cgpa').value = '';
                    document.getElementById('sem5Cgpa').value = '';
                    document.getElementById('sem6Cgpa').value = '';
                    document.getElementById('degreeMathMaxMarks').value = '';
                    document.getElementById('degreeMathMaxMarks').value = '';
                  }
                </script>
              </tr>
              <tr>
                <th style="background-color: #fecb1c">New System</th>
                <td colspan="3"></td>
              </tr>
              <script type="text/javascript">
                function degpercent() {
                   if (document.getElementById('aggrObtainedMarks').value != null && document.getElementById('aggrMaximumMarks').value != null) {
                      if (document.getElementById('aggrObtainedMarks').value > document.getElementById('aggrMaximumMarks').value) {
                         document.getElementById('aggrPercentage').value = 0;
                      }
                      else {
                         document.getElementById('aggrPercentage').value = (document.getElementById('aggrObtainedMarks').value / document.getElementById('aggrMaximumMarks').value)*100;
                         if (document.getElementById('aggrPercentage').value >100) {
                            document.getElementById('aggrPercentage').value = "error";
                         }
                      }
                   }
                }
              </script>
              <tr>
                <th>Aggr. Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="aggrObtainedMarks" name="aggrObtainedMarks" value="{{$user1[0]->degree_aggr_obt_marks}}" placeholder="Aggregate obtained Marks" onblur="degpercent()">
                </td>
                <th>Aggr. Max Marks</th>
                <td>
                  <input type="text" class="form-control" id="aggrMaximumMarks" name="aggrMaximumMarks" value="{{$user1[0]->degree_aggr_max_marks}}" placeholder="Aggregate obtained Marks" onblur="degpercent()">
                </td>
              </tr>
              <tr>
                <th>Percentage</th>
                <td>
                  <input type="text" class="form-control" id="aggrPercentage" name="aggrPercentage" value="{{$user1[0]->degree_percentage }}" placeholder="Percentage"  readonly="readonly">
                </td>
                <th>Final CGPA</th>
                <td>
                  <input type="text" class="form-control" id="finalCGPA" name="finalCGPA" value="{{$user1[0]->degree_final_cgpa }}" placeholder="Final CGPA">
                </td>
              </tr>
              <tr>
                <th style="background-color: #fecb1c">Old System</th>
                <td colspan="3"></td>
              </tr>
              <tr>
                <th>Sem 1 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_1_marks_obt" name="degree_1_marks_obt" value="{{$user1[0]->degree_sem_1_obt_marks}}" placeholder="Obtained Marks">
                </td>
                <th>Sem 1 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_1_marks_max" name="degree_1_marks_max" value="{{$user1[0]->degree_sem_1_max_marks}}" placeholder="Max Marks">
                </td>
              </tr>
              <tr>
                <th>Sem 2 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_2_marks_obt" name="degree_2_marks_obt" value="{{$user1[0]->degree_sem_2_obt_marks}}" placeholder="Obtained Marks">
                </td>
                <th>Sem 2 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_2_marks_max" name="degree_2_marks_max" value="{{$user1[0]->degree_sem_2_max_marks}}" placeholder="Max Marks">
                </td>
              </tr>
              <tr>
                <th>Sem 3 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_3_marks_obt" name="degree_3_marks_obt" value="{{$user1[0]->degree_sem_3_obt_marks}}" placeholder="Obtained Marks">
                </td>
                <th>Sem 3 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_3_marks_max" name="degree_3_marks_max" value="{{$user1[0]->degree_sem_3_max_marks}}" placeholder="Max Marks">
                </td>
              </tr>
              <tr>
                <th>Sem 4 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_4_marks_obt" name="degree_4_marks_obt" value="{{$user1[0]->degree_sem_4_obt_marks}}" placeholder="Obtained Marks">
                </td>
                <th>Sem 4 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_4_marks_max" name="degree_4_marks_max" value="{{$user1[0]->degree_sem_4_max_marks}}" placeholder="Max Marks">
                </td>
              </tr>
              <tr>
                <th>Sem 5 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_5_marks_obt" name="degree_5_marks_obt" value="{{$user1[0]->degree_sem_5_obt_marks}}" placeholder="Obtained Marks">
                </td>
                <th>Sem 5 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_5_marks_max" name="degree_5_marks_max" value="{{$user1[0]->degree_sem_5_max_marks}}" placeholder="Max Marks">
                </td>
              </tr>
              <tr>
                <th>Sem 6 obtained</th>
                <td>
                  <input type="text" class="form-control" id="degree_6_marks_obt" name="degree_6_marks_obt" value="{{$user1[0]->degree_sem_6_obt_marks}}" placeholder="Obtained Marks" onblur="olddegpercent()">
                </td>
                <th>Sem 6 Max</th>
                <td>
                  <input type="text" class="form-control" id="degree_6_marks_max" name="degree_6_marks_max" value="{{$user1[0]->degree_sem_6_max_marks}}" placeholder="Max Marks" onblur="olddegpercent()">
                </td>
              </tr>
              <script type="text/javascript">
                function olddegpercent() {
                  var aggrObt = parseInt(document.getElementById('degree_1_marks_obt').value) +
                                parseInt(document.getElementById('degree_2_marks_obt').value) +
                                parseInt(document.getElementById('degree_3_marks_obt').value) +
                                parseInt(document.getElementById('degree_4_marks_obt').value) +
                                parseInt(document.getElementById('degree_5_marks_obt').value) +
                                parseInt(document.getElementById('degree_6_marks_obt').value);
                
                  var aggrMax = parseInt(document.getElementById('degree_1_marks_max').value) +
                                parseInt(document.getElementById('degree_2_marks_max').value) +
                                parseInt(document.getElementById('degree_3_marks_max').value) +
                                parseInt(document.getElementById('degree_4_marks_max').value) +
                                parseInt(document.getElementById('degree_5_marks_max').value) +
                                parseInt(document.getElementById('degree_6_marks_max').value);
                
                  document.getElementById('oldAggrObtainedMarks').value = aggrObt;
                  document.getElementById('oldAggrMaximumMarks').value = aggrMax;
                
                  if (document.getElementById('oldAggrObtainedMarks').value != null && document.getElementById('oldAggrMaximumMarks').value != null) {
                     if (document.getElementById('oldAggrObtainedMarks').value > document.getElementById('oldAggrMaximumMarks').value) {
                        document.getElementById('oldAggrPercentage').value = 0;
                     }
                     else {
                        document.getElementById('oldAggrPercentage').value = (document.getElementById('oldAggrObtainedMarks').value / document.getElementById('oldAggrMaximumMarks').value)*100;
                        if (document.getElementById('oldAggrPercentage').value >100) {
                           document.getElementById('oldAggrPercentage').value = "error";
                        }
                     }
                  }
                
                }
              </script>
              <tr>
                <th>Aggr Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="oldAggrObtainedMarks" name="oldAggrObtainedMarks" value="{{$user1[0]->degree_aggr_obt_marks}}" placeholder="Aggregate Obtained" readonly="readonly">
                </td>
                <th>Aggr Max Marks</th>
                <td>
                  <input type="text" class="form-control" id="oldAggrMaximumMarks" name="oldAggrMaximumMarks" value="{{$user1[0]->degree_aggr_max_marks}}" placeholder="Aggregate Maximum" readonly="readonly">
                </td>
              </tr>
              <tr>
                <th>Final Percentage</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="oldAggrPercentage" name="oldAggrPercentage" value="{{$user1[0]->degree_percentage }}" placeholder="Percentage"  readonly="readonly">
                </td>
              </tr>
              <tr>
                <th style="background-color: #fecb1c">Provisional System</th>
                <td colspan="3"></td>
              </tr>
              <tr>
                <th>Sem 1 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem1Cgpa" name="sem1Cgpa" value="{{$user1[0]->degree_sem1_sgpa}}" placeholder="Sem 1 CGPA">   
                </td>
                <th>Sem 2 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem2Cgpa" name="sem2Cgpa" value="{{$user1[0]->degree_sem2_sgpa}}" placeholder="Sem 2 CGPA">   
                </td>
              </tr>
              <tr>
                <th>Sem 3 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem3Cgpa" name="sem3Cgpa" value="{{$user1[0]->degree_sem3_sgpa}}" placeholder="Sem 3 CGPA">   
                </td>
                <th>Sem 4 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem4Cgpa" name="sem4Cgpa" value="{{$user1[0]->degree_sem4_sgpa}}" placeholder="Sem 4 CGPA">   
                </td>
              </tr>
              <tr>
                <th>Sem 5 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem5Cgpa" name="sem5Cgpa" value="{{$user1[0]->degree_sem5_sgpa}}" placeholder="Sem 5 CGPA">   
                </td>
                <th>Sem 6 CGPA</th>
                <td>
                  <input type="text" class="form-control" id="sem6Cgpa" name="sem6Cgpa" value="{{$user1[0]->degree_sem6_sgpa}}" placeholder="Sem 6 CGPA">   
                </td>
              </tr>
              
              <tr style="text-align: center; background-color: #002147;">
                <td colspan="4">
                <button type="submit" class="btn btn" id="updateAcademicDetails" style="background-color: #002147; color: #ffffff">Update Academic Details</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          {{-- Personal Details --}}
        <form method="post" action="{{ route('update_mca_personal_details') }}">
          {{csrf_field()}}
          <table class="table table-bordered table-striped" id="personalDetails" style="display: none">
            <tbody>
               <tr> 
                <th>Name as on Marksheet</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="nameAsOnMarksheet" name="nameAsOnMarksheet" value = "{{$user1[0]->name_on_marksheet}}" placeholder="Name as on Marksheet">
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>
                  @foreach($genders as $key=>$gender)
                  @if( $gender != $user1[0]->gender OR $gender == "null")
                  <input type="radio" id="{{$key}}" name="gender" value="{{$gender}}">{{$key}}
                  @endif
                  @if( $gender == $user1[0]->gender )
                  <input type="radio"  id="{{$key}}" name="gender" value="{{$gender}}" checked>{{$key}}
                  @endif
                  @endforeach 
                </td>
                <th>Date of Birth</th>
                <td>
                  <input type="date" class="form-control" id="dob" name="dob" value = "{{$user1[0]->date_of_birth}}" placeholder="Date Of Birth">
                </td>
              </tr>
              <tr>
                <th>City of Birth</th>
                <td>
                  <input type="text" class="form-control" id="placeOfBirthCity" name="placeOfBirthCity" value = "{{$user1[0]->place_of_birth_city}}" placeholder="Enter City">
                </td>
                <th>State of Birth</th>
                <td>
                  <input type="text" class="form-control" id="placeOfBirthState" name="placeOfBirthState" value="{{$user1[0]->place_of_birth_state}}" placeholder="Enter State">
                </td>
              </tr>
              <tr>
                <th>Student Domicile No.</th>
                <td>
                  <input type="text" class="form-control" id="domicileNumber" name="domicileNumber" value = "{{$user1[0]->student_domicile_no}}" placeholder="Students Domicile No.">
                </td>
                <th>Student Domicile Date</th>
                <td>
                  <input type="date" class="form-control" id="domicileDate" name="domicileDate" value = "{{$user1[0]->student_domicile_date}}" placeholder="Date of Students Domicile">
                </td>
              </tr>
              <tr>
                <th>Student Domicile Appl. No.</th>
                <td>
                  <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" value = "{{$user1[0]->student_domicile_appl_no}}" placeholder="Students Domicile Application No.">
                </td>
                <th>Student Domicile Appl. Date</th>
                <td>
                  <input type="date" class="form-control" id="applictionDate" name="applictionDate" value = "{{$user1[0]->student_domicile_appl_date}}" placeholder="Date of Application of Students Domicile">
                </td>
              </tr>
              <tr>
                <th>Mother Tongue</th>
                <td>
                  <input type="text" class="form-control" id="motherTongue" name="motherTongue" value="{{$user1[0]->mother_tongue}}" placeholder="Mother Tongue">
                </td>
                <th>Nationality</th>
                <td>
                  <input type="text" class="form-control" id="nationality" name="nationality" value = "{{$user1[0]->nationality}}" placeholder="Nationality">
                </td>
              </tr>
              <tr>
                <th>Caste / Tribe</th>
                <td>
                  <input type="text" class="form-control" id="casteTribe" name="casteTribe" value = "{{$user1[0]->caste_tribe}}" placeholder="Caste/tribe">
                </td>
                <th>Religion</th>
                <td>
                  <input type="text" class="form-control" id="religion" name="religion" value="{{$user1[0]->religion}}" placeholder="Religion">
                </td>
              </tr>
              <tr>
                <th>Blood Group</th>
                <td>
                  <select class="form-control" id="bloodGroup" name="bloodGroup">
                     @foreach($blood_groups as $key=>$bloodGroup)
                    @if( $key == $user1[0]->blood_group )
                    <option value="{{$key}}" selected>{{$bloodGroup}}</option>
                    @else
                    <option value="{{$key}}">{{$bloodGroup}}</option>
                    @endif
                    @endforeach 
                  </select>
                </td>
                <th>UID ( Adhar Number )</th>
                <td>
                  <input type="text" class="form-control" id="uid" name="uid" maxlength="12" value="{{$user1[0]->uid }}" placeholder="Enter 12 digit Adhar Number">
                </td>
              </tr>
              <tr style="text-align: center; background-color: #002147;">
                <td colspan="4">
    
                    <button type="submit" class="btn btn" id="updatePersonalDetails" style="background-color: #002147; color: #ffffff">Update Personal Details</button>
                  
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          {{-- Guardian Details --}}
        <form method="post" action="{{ route('update_mca_guardian_details') }}">
          {{csrf_field()}}
          <table class="table table-bordered table-striped" id="guardianDetails" style="display: none">
            <tbody>
              <tr>
                <th>Husband / Father</th>
                <td colspan="3">
                   @foreach($relations as $key=>$relations)
                  @if( $user1[0]->g_relation != $relations)
                  <input type="radio" id="{{$key}}" name="relation" value="{{$relations}}">&nbsp;{{$key}}&nbsp;&nbsp;
                  @endif
                  @if( $user1[0]->g_relation == $relations )
                  <input type="radio"  id="{{$key}}" name="relation" value="{{$relations}}" checked>&nbsp;{{$key}}&nbsp;&nbsp;
                  @endif
                  @endforeach 
                </td>
              </tr>
              <tr>
                <th>First Name</th>
                <td>
                  <input type="text" class="form-control" id="firstName" name="firstName" value="{{$user1[0]->g_first_name}}" placeholder="First Name">
                </td>
                <th>Middle Name</th>
                <td>
                  <input type="text" class="form-control" id="middleName" name="middleName" value="{{$user1[0]->g_middle_name}}" placeholder="Middle Name">
                </td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td>
                  <input type="text" class="form-control" id="lastName" name="lastName" value="{{$user1[0]->g_last_name}}" placeholder="Last Name">
                </td>
                <th>Mother's Name</th>
                <td>
                  <input type="text" class="form-control" id="motherMaidenName" name="motherMaidenName" value="{{$user1[0]->mother_name}}" placeholder="Mother’s Name"> 
                </td>
              </tr>
              <tr>
                <th>Mobile No.</th>
                <td>
                  <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user1[0]->g_mobile}}" placeholder="Mobile No">
                </td>
                <th>Occupation</th>
                <td>
                  <input type="text" class="form-control" id="occupation" name="occupation" value="{{$user1[0]->g_occupation}}" placeholder="Occupation">
                </td>
              </tr>
              <tr>
                <th>Office Address</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="office_address" name="office_address" value="{{$user1[0]->g_office_address}}" placeholder="Office Address">
                </td>
              </tr>
              <tr>
                <th>Office Telephone No.</th>
                <td>
                  <input type="text" class="form-control" id="office_tel_no" name="office_tel_no" value="{{$user1[0]->g_office_tel_no}}" placeholder="Office Telephone No">
                </td>
                <th>Qualification</th>
                <td>
                  <input type="text" class="form-control" id="qualification" name="qualification" value="{{$user1[0]->g_qualification}}" placeholder="Qualification">
                </td>
              </tr>
              <tr>
                <th>Family's Annual Income</th>
                <td>
                  <input type="text" class="form-control" id="annualIncome" name="annualIncome" value="{{$user1[0]->g_annual_income}}" placeholder="Enter Family Annual Income">
                </td>
              </tr>
              <tr>
                <th>Parrent Domicile No.</th>
                <td>
                  <input type="text" class="form-control" id="parentDomecileNo" name="parentDomecileNo" value="{{$user1[0]->parent_domicile_no}}" placeholder="Parent’s Domicile No">
                </td>
                <th>Domicile Date</th>
                <td>
                  <input type="date"  class="form-control" id="dateOfParentDomecile" name="dateOfParentDomecile"
                    value="{{$user1[0]->parent_domicile_date}}" placeholder="Date of Parent’s Domicile">
                </td>
              </tr>
              <tr>
                <th>Parrent Domicile Appl. No.</th>
                <td>
                  <input type="text" class="form-control" id="parentDomecileApplicationNo" name="parentDomecileApplicationNo" value="{{$user1[0]->parent_domicile_appl_no}}"placeholder="Parent’s Domicile Application No">
                </td>
                <th>Domicile Appl. Date</th>
                <td>
                  <input type="date"  class="form-control" id="applicationDateOfParentDomecile" name="applicationDateOfParentDomecile" value="{{$user1[0]->parent_domicile_appl_date}}" placeholder="Application Date of Parent’s Domicile">
                </td>
              </tr>
              <tr style="text-align: center; background-color: #002147;">
                <td colspan="4">
                 
                    <button type="submit" class="btn btn" id="updateGuardianDetails" style="background-color: #002147; color: #ffffff">Update Guardian Details</button>
                
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          {{-- Contact Details --}}
        <form method="post" action="{{ route('update_mca_contact_details') }}">
          {{csrf_field()}}
          <table class="table table-bordered table-striped" id="contactDetails" style="display: none">
            <tbody>
              <tr>
                <th style="background-color: #fecb1c">Permanent Address</th>
                <td colspan="3"></td>
              </tr>
              <tr>
                <th>Address Line 1</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="permanentAddressLine1" name="permanentAddressLine1" value="{{$user1[0]->permanent_address_line1}}" placeholder="Address Line 1">
                </td>
              </tr>
              <tr>
                <th>Address Line 2</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="permanentAddressLine2" name="permanentAddressLine2" value="{{$user1[0]->permanent_address_line2}}" placeholder="Address Line 2">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="permanentAddressCity" name="permanentAddressCity" value="{{$user1[0]->permanent_city}}" placeholder="Enter City">
                </td>
                <th>District</th>
                <td>
                  <input type="text" class="form-control" id="permanentAddressDistrict" name="permanentAddressDistrict" value="{{$user1[0]->permanent_district}}" placeholder="Enter District">
                </td>
              </tr>
              <tr>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="permanentAddressState" name="permanentAddressState" value="{{$user1[0]->permanent_state}}" placeholder="Enter State">
                </td>
                <th>Pincode</th>
                <td>
                  <input type="text" class="form-control" id="permanentAddressPincode" name="permanentAddressPincode" value="{{$user1[0]->permanent_pincode}}"  placeholder="Enter Pincode">
                </td>
              </tr>
              <tr>
                <th>Nearest Railway Station</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="permanentAddressNearestRailwayStation" name="permanentAddressNearestRailwayStation" value="{{$user1[0]->permanent_nearest_rail_station}}" placeholder="Nearest Railway Station">
                </td>
              </tr>
            <!--  <tr>
                <th>Same as Above</th>
                <td colspan="3">
                   @if($permanent == "true" )
                  <input type="checkbox" id="isSame" name="isSame" value="Yes" onload="fillAddress()" onclick="fillAddress()" checked>Yes
                  @else
                  <input type="checkbox" id="isSame" name="isSame" value="yes" onclick="fillAddress()" >Yes 
                  @endif 
                </td>
                <script type="text/javascript">
                  function fillAddress() {
                     if (document.getElementById('isSame').checked) {
                        document.getElementById('currentAddressLine1').value = document.getElementById('permanentAddressLine1').value;
                        document.getElementById('currentAddressLine1').disabled = true;
                        document.getElementById('currentAddressLine2').value = document.getElementById('permanentAddressLine2').value;
                        document.getElementById('currentAddressLine2').disabled = true;
                        document.getElementById('currentAddressCity').value = document.getElementById('permanentAddressCity').value;
                        document.getElementById('currentAddressCity').disabled = true;
                        document.getElementById('currentAddressDistrict').value = document.getElementById('permanentAddressDistrict').value;
                        document.getElementById('currentAddressDistrict').disabled = true;
                        document.getElementById('currentAddressState').value = document.getElementById('permanentAddressState').value;
                        document.getElementById('currentAddressState').disabled = true;
                        document.getElementById('currentAddressPincode').value = document.getElementById('permanentAddressPincode').value;
                        document.getElementById('currentAddressPincode').disabled = true;
                        document.getElementById('currentAddressNearestRailwayStation').value = document.getElementById('permanentAddressNearestRailwayStation').value;
                        document.getElementById('currentAddressNearestRailwayStation').disabled = true;
                     }
                     else{
                        document.getElementById('currentAddressLine1').value = "";
                        document.getElementById('currentAddressLine1').disabled = false;
                        document.getElementById('currentAddressLine2').value = "";
                        document.getElementById('currentAddressLine2').disabled = false;
                        document.getElementById('currentAddressCity').value = "";
                        document.getElementById('currentAddressCity').disabled = false;
                        document.getElementById('currentAddressDistrict').value = "";
                        document.getElementById('currentAddressDistrict').disabled = false;
                        document.getElementById('currentAddressState').value = "";
                        document.getElementById('currentAddressState').disabled = false;
                        document.getElementById('currentAddressPincode').value = "";
                        document.getElementById('currentAddressPincode').disabled = false;
                        document.getElementById('currentAddressNearestRailwayStation').value = "";
                        document.getElementById('currentAddressNearestRailwayStation').disabled = false;
                     }
                  }
                </script>
              </tr>-->
              <tr>
                <th style="background-color: #fecb1c">Current Address</th>
                <td colspan="3"></td>
              </tr>
              <tr>
                <th>Address Line 1</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="currentAddressLine1" name="currentAddressLine1" value="{{$user1[0]->correspondance_address_line1}}" placeholder="Address Line 1">
                </td>
              </tr>
              <tr>
                <th>Address Line 2</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="currentAddressLine2" name="currentAddressLine2" value="{{$user1[0]->correspondance_address_line2}}" placeholder="Address Line 2">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="currentAddressCity" name="currentAddressCity" value="{{$user1[0]->correspondance_city}}" placeholder="Enter City">
                </td>
                <th>District</th>
                <td>
                  <input type="text" class="form-control" id="currentAddressDistrict" name="currentAddressDistrict" value="{{$user1[0]->correspondance_district}}" placeholder="Enter District">
                </td>
              </tr>
              <tr>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="currentAddressState" name="currentAddressState" value="{{$user1[0]->correspondance_state}}" placeholder="Enter State">
                </td>
                <th>Pincode</th>
                <td>
                  <input type="text" class="form-control" id="currentAddressPincode" name="currentAddressPincode" value="{{$user1[0]->correspondance_pincode}}"  placeholder="Pincode">
                </td>
              </tr>
              <tr>
                <th>Nearest Railway Station</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="currentAddressNearestRailwayStation" name="currentAddressNearestRailwayStation" value="{{$user1[0]->correspondance_nearest_rail_station}}"  placeholder="Nearest Railway Station">
                </td>
              </tr>
              <tr>
                <th style="background-color: #fecb1c">Local / Outstation</th>
                <td colspan="3">
                  <button type="button" class="btn" onclick="clearLocal()" style="background-color: #002147; color: #ffffff;">Clear Local Guardian Details</button>
                </td>
                <script type="text/javascript">
                  function  clearLocal() {
                    document.getElementById('localGuardianName').value = '';
                    document.getElementById('localGuardianAddressLine1').value = '';
                    document.getElementById('localGuardianAddressLine2').value = '';
                    document.getElementById('localGuardianAdreessCity').value = '';
                    document.getElementById('localGuardianAdreessDristict').value = '';
                    document.getElementById('localGuardianAddressState').value = '';
                    document.getElementById('localGuardianAddressPincode').value = '';
                    document.getElementById('localNearestRailwayStation').value = '';
                  }
                </script>
              </tr>
              <tr>
                <th>Local Guardian Name</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="localGuardianName" name="localGuardianName" value="{{$user1[0]->local_guardian_name}}" placeholder="Local Guadian Name">
                </td>
              </tr>
              <tr>
                <th>Address Line 1</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="localGuardianAddressLine1" name="localGuardianAddressLine1" value="{{$user1[0]->local_guardian_address_line1}}" placeholder="Address Line 1">
                </td>
              </tr>
              <tr>
                <th>Address Line 2</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="localGuardianAddressLine2" name="localGuardianAddressLine2" value="{{$user1[0]->local_guardian_address_line2}}" placeholder="Address Line 2">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="localGuardianAdreessCity" name="localGuardianAdreessCity" value="{{$user1[0]->local_guardian_city}}" placeholder="Enter City">
                </td>
                <th>District</th>
                <td>
                  <input type="text" class="form-control" id="localGuardianAdreessDristict" name="localGuardianAdreessDristict" value="{{$user1[0]->local_guardian_city}}" placeholder="Enter District">
                </td>
              </tr>
              <tr>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="localGuardianAddressState" name="localGuardianAddressState" value="{{$user1[0]->local_guardian_state}}" placeholder="Enter State">
                </td>
                <th>Pincode</th>
                <td>
                  <input type="text" class="form-control" id="localGuardianAddressPincode" name="localGuardianAddressPincode" value="{{$user1[0]->local_guardian_pincode}}"  placeholder="Pincode">
                </td>
              </tr>
              <tr>
                <th>Nearest Railway Station</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="localNearestRailwayStation" name="localNearestRailwayStation" value="{{$user1[0]->correspondance_nearest_rail_station}}" placeholder="Nearest Railway Station">
                </td>
              </tr>
              <tr style="text-align: center; background-color: #002147;">
                <td colspan="4">
                  
                    <button type="submit" class="btn btn" id="updateContactDetails" style="background-color: #002147; color: #ffffff">Update Contact Details</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
        
<form method="post" action="{{ url('mailpage') }}">
          <table style="width: 1080px; margin-left: 15px;" class="table table-bordered table-striped">
              <tr>
                <td style="background-color: #002147;width: 100px;">
                 <label style="color: white; font-size: 10" >Content to mail</label>
                </td>
                <td style="background-color: #002147; " >
                  <textarea name="mail" id="mail" style="width: 100%;"></textarea>
                </td>
                <td style="background-color: #002147;"  >
                  <button type="submit" class="btn btn" onclick=" return check()" id="mail" style="background-color: #002147; color: #ffffff">Mail</button>
                     <script type="text/javascript">
                    function check() {

                      var txt=document.getElementById('mail').value;
                      if(txt=="")
                      {
                        alert('select any value before sending');
                        return false;

                      }
                    }
                  </script>
                
               
                
              <textarea name="textmail" id="textmail" style="display: none;"></textarea>
                </td>
              </tr>

          </table>
        </form>

      
      <script type="text/javascript">
  $(window).load(function() {
    var a="";
     a=(window.location.pathname).toString();
     a=a.substr(1);
   document.getElementById('textmail').innerHTML=a;
   // alert(document.getElementById('textmail').innerHTML);
  });
</script>


        </div>
      </div>
  </div>
</div>
<br><br><br>
@endsection