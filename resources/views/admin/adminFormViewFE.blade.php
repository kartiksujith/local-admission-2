@extends('layout.adminApp')
@section('content')
<div class="container">
  <div class="col-md-12">
    <body onload="abc('{{$user1[0]->is_cet}}','{{$user1[0]->is_jee}}')">
    <h1>Form View</h1>
    <form>
      {{csrf_field()}}
     <br>
      <div class="col-md-12">
        <div class="form-group">
            <script type="text/javascript">
            function abc(cet,jee){
        

        if(cet == '0')
        {
          document.getElementById('cetSeatNumber').value = '';
          document.getElementById('cetMonth').value = '';
          document.getElementById('cetYear').value = '';
          document.getElementById('cetMathsScore').value = '';
          document.getElementById('cetPhysicsScore').value = '';
          document.getElementById('cetChemistryScore').value = '';
          document.getElementById('cetScore').value = '';
       }

       if(jee == '0')
        {
          
          document.getElementById('jeeSeatNumber').value = '';
          document.getElementById('jeePhysicsScore').value = '';
          document.getElementById('jeeMathsScore').value = '';
          document.getElementById('jeeChemistryScore').value = '';
          document.getElementById('jeeScore').value = '';
          document.getElementById('jeeMonth').value = "";
          document.getElementById('jeeYear').value = "";
       }
            }
          </script>
          
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
        <form method="post" action="{{ route('update_fe_dte_details') }}">
          {{csrf_field()}}
          <table  id="dteDetails" class="table table-bordered table-striped" style="display: none;">
            <tbody>
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
                  <input type="text" class="form-control" id="capRound" name="capRound" value="{{$user1[0]->allotted_cap_round}}"  placeholder="Allotted Cap Round" Readonly>
                </td>
                
                <th>Seat Type</th>
                <td>
                  <input type="text" class="form-control" id="seatType" name="seatType" value="{{$user1[0]->seat_type}}"  placeholder="Seat Type" Readonly>
                </td>
              </tr>
              <tr>
                <th>Course Allotted</th>
                <td>
                  <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->course_allotted}}"  placeholder="Course Allotted" Readonly>
                </td>
                <th>Course Code</th>
                <td>
                  <input type="text" class="form-control" id="courseCode" name="courseCode" value="{{$user1[0]->course_allotted_code}}"  placeholder="Course Code" Readonly>
                </td>
              </tr>
              <tr>
                <th>Shift Allotted</th>
                <td>
                  <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->shift_allotted}}"  placeholder="Course Allotted" Readonly>
                </td> 
                 <th>Branch</th>
                <td>
                  <input type="text" class="form-control" id="courseAllotted" name="courseAllotted" value="{{$user1[0]->dte_branch}}"  placeholder="Course Allotted" Readonly>
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
        <form method="post" action="{{ route('update_fe_academic_details') }}">
          {{csrf_field()}}
          <table class="table table-bordered table-striped" id="academicDetails" style="display: none">
            <tbody>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">10TH Details</th>
              </tr>
              <tr>
                <th>SSC School Name</th>
                <td>
                  <input type="text" class="form-control" id="sscSchool" name="sscSchool" value="{{$user1[0]->x_school_name}}" placeholder="Enter SSC School name">
                </td>
                <th>SSC Board Name</th>
                <td>
                  <input type="text" class="form-control" id="sscBoard" name="sscBoard" value="{{$user1[0]->x_board}}" placeholder="Enter SSC Board name">
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="sscCity" name="sscCity" value="{{$user1[0]->x_school_city}}" placeholder="Enter City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="sscState" name="sscState" value="{{$user1[0]->x_school_state}}" placeholder="Enter State">
                </td>
              </tr>
              <tr>
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
                  <select id="xPassingYear" name="xPassingYear" class="form-control" >
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
                <td>
                  <input type="text" class="form-control" id="xPercentage" name="xPercentage" value="{{$user1[0]->x_percentage}}" placeholder="Percentage" readonly="readonly">
                </td>

                <th>Seat No</th>
                <td>
                  <input type="text" class="form-control" id="sscBoardNumber" name="sscBoardNumber"  value="{{$user1[0]->x_board_seat_no}}" placeholder="Seat No">
                </td>
              </tr>
              <tr>
                <th colspan="4" style="background-color: #fecb1c">12TH Details</th>
              </tr>
              <tr>
                <th>HSC College Name</th>
                <td>
                  <input type="text" class="form-control" id="hscCollege" name="hscCollege" value="{{$user1[0]->xii_college_name}}" placeholder="Enter College Name">
                </td>
                <th>Board Name</th>
                <td>
                  <input type="text" class="form-control" id="hscBoard" name="hscBoard" value="{{$user1[0]->xii_board}}" placeholder="Enter Board Name">                  
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control" id="hscCity" name="hscCity" value="{{$user1[0]->xii_college_city}}" placeholder="Enter City">
                </td>
                <th>State</th>
                <td>
                  <input type="text" class="form-control" id="hscState" name="hscState" value="{{$user1[0]->xii_college_state}}" placeholder="Enter State">
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
                  <select id="xiiPassingYear" name="xiiPassingYear" class="form-control" >
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
                document.getElementById("xiiPassingYear").innerHTML = options;
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
                <td>
                  <input type="text" class="form-control" id="xiiPercentage" name="xiiPercentage"  value="{{$user1[0]->xii_percentage}}" placeholder="Percentage" readonly="readonly">
                </td>
                <th>Seat No</th>
                <td>
                  <input type="text" class="form-control" id="hscBoardNumber" name="hscBoardNumber"  value="{{$user1[0]->xii_board_seat_no}}" placeholder="Seat No">
                </td>
              </tr>
              <tr>
                <th>Obtained Marks in Maths</th>
                <td>
                  <input type="text" class="form-control" id="hscMathsObtainMarks" name="hscMathsObtainMarks" value="{{$user1[0]->xii_maths_obtained_marks}}" onblur="calAggr()" placeholder="Enter Marks">
                </td>
                <th>Maximum Marks( Out Of )</th>
                <td>
                  <input type="text" class="form-control" id="hscMathsMaxMarks" name="hscMathsMaxMarks" value="{{$user1[0]->xii_maths_max_marks}}" onblur="calAggr()" placeholder="Enter Marks">
                </td>
              </tr>
              <tr>
                <th>Obtained Marks in Physics</th>
                <td>
                  <input type="text" class="form-control" id="hscPhysicsObtainMarks" name="hscPhysicsObtainMarks" value="{{$user1[0]->xii_physics_obtained_marks}}" onblur="calAggr()" placeholder="Enter Marks">
                </td>
                <th>Maximum Marks( Out Of )</th>
                <td>
                  <input type="text" class="form-control" id="hscPhysicsMaxMarks" name="hscPhysicsMaxMarks" value="{{$user1[0]->xii_physics_max_marks}}" onblur="calAggr()" placeholder="Enter Marks">
                </td>
              </tr>
              
              <tr>
                <th>Obtained Marks in Chemistry</th>
                <td>
                  <input type="text" class="form-control" id="hscChemistryObtainMarks" name="hscChemistryObtainMarks" onblur="calAggr()" value="{{$user1[0]->xii_chemistry_obtained_marks}}" placeholder="Enter Marks">
                </td>
                <th>Maximum Marks( Out Of )</th>
                <td>
                  <input type="text" class="form-control" id="hscChemistryMaxMarks" name="hscChemistryMaxMarks" value="{{$user1[0]->xii_chemistry_max_marks}}" onblur="calAggr()" placeholder="Enter Marks">
                </td>
              </tr>
              
              <tr>
                <th>PCM Total Marks</th>
                <td colspan="3">
                  <input type="text" class="form-control" id="hscAggregateMarks" name="hscAggregateMarks"  value="{{$user1[0]->xii_aggregate_marks}}" placeholder="Aggregate Marks" readonly="readonly">
                </td>
              </tr>
                <script type="text/javascript">
                function calAggr()
                {
                  var obtMaths = parseInt(document.getElementById('hscMathsObtainMarks').value);
                  var obtPhy = parseInt(document.getElementById('hscPhysicsObtainMarks').value);
                  var obtChem = parseInt(document.getElementById('hscChemistryObtainMarks').value);
                  var MaxMaths = parseInt(document.getElementById('hscMathsMaxMarks').value);
                  var MaxPhy = parseInt(document.getElementById('hscPhysicsMaxMarks').value);
                  var MaxChem = parseInt(document.getElementById('hscChemistryMaxMarks').value);
                  var MaxTot = MaxMaths + MaxPhy + MaxChem;
                  var Agg = obtMaths + obtPhy + obtChem;
                  document.getElementById('hscAggregateMarks').value =Agg ;
                  // document.getElementById('hscAggregateMarks').value = ((Agg/MaxTot)*100);
                }
              </script>

              <tr>
                <th>Vocational Subject 1</th>
                <td>
                  
                  <select id="hscVocationalSubject1" name="hscVocationalSubject1" value="{{$user1[0]->xii_vocational_subject1}}" class="form-control" required>
                @foreach($vocational_subjects as $key=>$vocational_subject)
                @if( $user1[0]->xii_vocational_subject1 == $key )
                <option value="{{$key}}" selected>{{$vocational_subject}}</option>
                @endif
                @if( $user1[0]->xii_vocational_subject1 != $key )
                <option value="{{$key}}">{{$vocational_subject}}</option>
                @endif
                @endforeach
              
                </td>
                <th>Vocational Subject 1 Code</th>
                <td>
                  <input type="text" class="form-control" id="hscVocationalSubject1Code" name="hscVocationalSubject1Code" value="{{$user1[0]->xii_vocational_subject1_code}}" placeholder="Vocational Subject 1 Code">
                </td>
              </tr>
              <tr>
                <th>Vocational Subject 1 Obtained Marks</th>
                <td>
                  <input type="text" class="form-control" id="hscVocationalSubject1ObtainMarks" name="hscVocationalSubject1ObtainMarks" value="{{$user1[0]->xii_vocational_subject1_obtained_marks}}" placeholder="Vocational Subject 1 Obtained Marks">
                </td>
                <th>Vocational Subject 1 Max Marks</th>
                <td>
                  <input type="text" class="form-control" id="hscVocationalSubject1MaxMarks" name="hscVocationalSubject1MaxMarks" value="{{$user1[0]->xii_vocational_subject1_max_marks}}" placeholder="Vocational Subject 1 Max Marks">
                </td>
              </tr>
              
              
              
              <tr>
                <th colspan="2">CET/JEE</th>
                <td>
                  <button type="button" class="btn" onclick="clearCET()" style="background-color: #002147; color: #ffffff;">Clear CET</button>
                </td>
                <td>
                  <button type="button" class="btn" onclick="clearJEE()" style="background-color: #002147; color: #ffffff;">Clear JEE</button>
                </td>
                <script type="text/javascript">
                  function  clearCET() {
                    document.getElementById('cetSeatNumber').value = '';
                    document.getElementById('cetMonth').value = '';
                    document.getElementById('cetYear').value = '';
                    document.getElementById('cetMathsScore').value = '';
                    document.getElementById('cetPhysicsScore').value = '';
                    document.getElementById('cetChemistryScore').value = '';
                    document.getElementById('cetScore').value = '';
                  }
                  function  clearJEE() {
                    document.getElementById('jeeSeatNumber').value = '';
                    document.getElementById('jeePhysicsScore').value = '';
                    document.getElementById('jeeMathsScore').value = '';
                    document.getElementById('jeeChemistryScore').value = '';
                    document.getElementById('jeeScore').value = '';
                    
                  }
                </script>
              </tr>

              <tr>
                <th colspan="4" style="background-color: #fecb1c">CET Details</th>
              </tr>
              <tr>
                <th>CET Seat Number</th>
                <td>
                  <input type="text" class="form-control" id="cetSeatNumber" name="cetSeatNumber" value="{{$user1[0]->cet_seat_no}}" placeholder="CET Seat Number">
                </td>
                <th>Year</th>
                <td>
                  <select id="cetYear" name="cetYear" class="form-control" >
              </select>
            
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->cet_year}};
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
                document.getElementById("cetYear").innerHTML = options;
              </script>
                </td>
              </tr>
              <tr>
                <th>Month</th>
                <td>
              <select id="cetMonth" name="cetMonth" class="form-control" >
               @foreach($months as $key=>$month)
                @if( $user1[0]->cet_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->cet_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                <th>Maths Score</th>
                <td>
                  <input type="text" class="form-control" id="cetMathsScore" name="cetMathsScore" value="{{$user1[0]->cet_maths}}" placeholder="Enter State">
                </td>
              </tr>
              <tr>
                <th>Physics</th>
                <td>
                  <input type="text" class="form-control" id="cetPhysicsScore" name="cetPhysicsScore" value="{{$user1[0]->cet_physics}}" placeholder="Enter Month">
                </td>
                <th>Chemistry</th>
                <td>
                  <input type="text" class="form-control" id="cetChemistryScore" name="cetChemistryScore"  value="{{$user1[0]->cet_chemistry}}">
                </td>
              </tr>
              <tr>
                <th>CET Score</th>
                <td>
                  <input type="text" class="form-control" id="cetScore" name="cetScore" value="{{$user1[0]->cet_score}}" placeholder="CET Score">
                </td>
              </tr>
              
             
               <tr>
                <th colspan="4" style="background-color: #fecb1c">JEE Details</th>
              </tr>
              <tr>
                <th>JEE Seat Number</th>
                <td>
                  <input type="text" class="form-control" id="jeeSeatNumber" name="jeeSeatNumber" value="{{$user1[0]->jee_seat_no}}" placeholder="JEE Seat Number">
                </td>

                <th>Year</th>
                <td>
                  <select id="jeeYear" name="jeeYear" class="form-control" >
              </select>
            
            <script type="text/javascript">
                var dt = new Date();
                var year = 1990;
                var till = dt.getYear() + 1900;
                var options = "";
                var x ={{  $user1[0]->jee_year}};
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
                document.getElementById("jeeYear").innerHTML = options;
              </script>
                </td>
              </tr>

              <tr>
                <th>Month</th>
                <td>
              <select id="jeeMonth" name="jeeMonth" class="form-control" >
               @foreach($months as $key=>$month)
                @if( $user1[0]->jee_month == $key )
                <option value="{{$key}}" selected>{{$month}}</option>
                @endif
                @if( $user1[0]->jee_month != $key )
                <option value="{{$key}}">{{$month}}</option>
                @endif
                @endforeach
              </select>

                </td>
                
                <th>Maths Score</th>
                <td>
                  <input type="text" class="form-control" id="jeeMathsScore" name="jeeMathsScore" value="{{$user1[0]->jee_maths_score}}" placeholder="Maths Score">
                </td>
              </tr>
              <tr>
                <th>Physics Score</th>
                <td>
                  <input type="text" class="form-control" id="jeePhysicsScore" name="jeePhysicsScore" value="{{$user1[0]->jee_physics_score}}" placeholder="Physics Score">
                </td>
                <th>Chemistry Score</th>
                <td>
                  <input type="text" class="form-control" id="jeeChemistryScore" name="jeeChemistryScore"  value="{{$user1[0]->jee_chemistry_score}}" placeholder="Chemistry Score">
                </td>
              </tr>
              <tr>
                <th>JEE Score</th>
                <td>
                  <input type="text" class="form-control" id="jeeScore" name="jeeScore" value="{{$user1[0]->jee_score}}" placeholder="JEE Score">
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
        <form method="post" action="{{ route('update_fe_personal_details') }}">
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
        <form method="post" action="{{ route('update_fe_guardian_details') }}">
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
        <form method="post" action="{{ route('update_fe_contact_details') }}">
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
                  <input type="text" class="form-control" id="localGuardianAdreessDristict" name="localGuardianAdreessDristict" value="{{$user1[0]->local_guardian_district}}" placeholder="Enter District">
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
                  <input type="text" class="form-control" id="localNearestRailwayStation" name="localNearestRailwayStation" value="{{$user1[0]->local_guardian_nearest_rail_station}}" placeholder="Nearest Railway Station">
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
          <table style="width: 1080px;" class="table table-bordered table-striped">
              <tr>
                <td style="background-color: #002147;width: 100px;">
                 <label style="color: white; font-size: 10" >Content to mail</label>
                </td>
                <td style="background-color: #002147; " >
                  <textarea name="mail" id="mail" style="width: 100%;"></textarea>
                </td>
                <td style="background-color: #002147;"  >
                  <button type="submit" class="btn btn" id="mail" onclick="return check()" style="background-color: #002147; color: #ffffff">Mail</button>
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